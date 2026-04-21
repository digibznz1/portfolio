<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Models\Scopes\StatusScope;
use App\Models\Scopes\OrderIndexScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Scope;

#[Fillable(['name', 'description', 'status', 'parent_id', 'admin_id'])]

class Category extends Authenticatable
{
    use HasFactory;

    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    #[Scope]
    public function scopeStandards(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    #[Scope]
    public function scopeFields(Builder $query): Builder
    {
        return $query->whereNotNull('parent_id');
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($value) => now()->parse($value)->format('Y-m-d'));

    }//end of get createdAt Attribute

    protected static function booted(): void
    {
        static::addGlobalScope(new OrderIndexScope);

        if(!request()->is('*categories*')) static::addGlobalScope(new StatusScope);

    }//end of Global Scope

}//end pf model