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

#[Fillable(['name', 'email', 'password', 'status', 'description', 'organization_type_id', 'image'])]
#[Hidden(['password', 'remember_token'])]
#[Appends(['image_path'])]

class Organization extends Authenticatable
{
    use HasFactory;

    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image != 'default.png' ? asset('storage/' . $this->image) : asset('admin_assets/media/admin/default.png'),
        );

    }//end of get ImagePath Attribute

    public function scopeOrganizationTypeJoin(Builder $query): Builder
    {
        return $query->leftJoin('organization_types', 'organizations.organization_type_id', '=', 'organization_types.id')
                     ->select('organizations.*', 'organization_types.name as organization_type_name');

    }//end of scope Role

    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($value) => now()->parse($value)->format('Y-m-d'));

    }//end of get createdAt Attribute

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? (Hash::needsRehash($value) ? bcrypt($value) : $value) : $this->password
        );
    }//end of Global Scope

    protected static function booted(): void
    {
        static::addGlobalScope(new OrderScope);

        if(!request()->is('*organizations*')) static::addGlobalScope(new StatusScope);

    }//end of Global Scope

}//end pf model
