<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Support\Facades\Hash;
use App\Models\Scopes\StatusScope;
use App\Models\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Builder;

#[Fillable(['name', 'email', 'permissions', 'role_id', 'password', 'status', 'image'])]
#[Hidden(['password', 'remember_token'])]
#[Appends(['image_path'])]

class Admin extends Authenticatable
{
    use HasFactory;

    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image != 'default.png' ? asset('storage/' . $this->image) : asset('admin_assets/media/admin/default.png'),
        );

    }//end of get ImagePath Attribute

    public function scopeRoleJoin(Builder $query): Builder
    {
        return $query->join('roles', 'admins.role_id', '=', 'roles.id')
                     ->select('admins.*', 'roles.name as role_name');

    }//end of scope Role

    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($value) => now()->parse($value)->format('Y-m-d'));

    }//end of get createdAt Attribute

    public function permissions(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_validate($value) ? json_decode($value, true) : $value,
            set: fn($value) => is_array($value) ? json_encode($value) : $value
        );
    }

    public function hasPermission(?string $permission): bool
    {
        if (auth('admin')->user()->user_role_id == 1) return true;

        $permissions = $this->permissions ?? [];
        return in_array($permission, $permissions);
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? (Hash::needsRehash($value) ? bcrypt($value) : $value) : $this->password
        );
    }//end of Global Scope

    protected static function booted(): void
    {
        static::addGlobalScope(new OrderScope);

        if(!request()->is('*admins*')) static::addGlobalScope(new StatusScope);

    }//end of Global Scope

}//end pf model
