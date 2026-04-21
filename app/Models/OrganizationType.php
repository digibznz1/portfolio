<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StatusScope;
use App\Models\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Casts\Attribute;

#[Fillable(['name', 'status'])]
class OrganizationType extends Model
{
    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($value) => now()->parse($value)->format('Y-m-d'));

    }//end of get createdAt Attribute
    
    protected static function booted(): void
    {
        static::addGlobalScope(new OrderScope);

        if(!request()->is('*organization_types*')) static::addGlobalScope(new StatusScope);

    }//end of Global Scope

}//end of class