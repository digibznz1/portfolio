<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Scopes\OrderIndexScope;
use App\Models\Scopes\StatusScope;
use Spatie\Translatable\HasTranslations;

#[Fillable(['name', 'position', 'bio', 'image', 'index', 'status'])]
class TeamMember extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['name', 'position', 'bio'];

    protected static function booted(): void
    {
        static::addGlobalScope(new OrderIndexScope);

        if (!request()->is('*team*')) {
            static::addGlobalScope(new StatusScope);
        }
    }

}//end of model
