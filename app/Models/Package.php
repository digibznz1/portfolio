<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Models\Scopes\OrderIndexScope;
use App\Models\Scopes\StatusScope;
use Spatie\Translatable\HasTranslations;

#[Fillable(['name', 'subtitle', 'price', 'price_unit', 'features', 'button_text', 'button_style', 'is_featured', 'index', 'status'])]
class Package extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['name', 'subtitle', 'price_unit', 'button_text'];

    protected $casts = [
        'features'    => 'array',
        'is_featured' => 'boolean',
        'status'      => 'boolean',
    ];

    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($value) => now()->parse($value)->format('Y-m-d'));

    }//end of get createdAt Attribute

    protected static function booted(): void
    {
        static::addGlobalScope(new OrderIndexScope);

        if (!request()->is('*packages*')) static::addGlobalScope(new StatusScope);
    }

}//end of model
