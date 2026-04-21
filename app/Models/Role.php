<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

#[Fillable(['name', 'permissions'])]
class Role extends Model
{
    use HasFactory;

    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class, 'role_id');

    }//end of hasMany admin

    public function scopeAdminJoin(Builder $query): Builder
    {
        return $query;
        return $query->join('admins', 'roles.admin_id', '=', 'admins.id')
                     ->select('roles.*', 'admins.name as admin_name');

    }//end of scope Role

    public function permissions(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_validate($value) ? json_decode($value, true) : $value,
            set: fn($value) => is_array($value) ? json_encode($value) : $value
        );
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($value) => now()->parse($value)->format('Y-m-d'));

    }//end of get createdAt Attribute

}//end pf model
