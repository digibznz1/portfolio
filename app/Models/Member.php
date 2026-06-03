<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Appends;
use App\Models\Scopes\StatusScope;
use App\Models\Scopes\OrderScope;
use Spatie\Translatable\HasTranslations;

#[Fillable(['name', 'position', 'bio', 'image', 'index', 'status'])]
#[Appends(['image_path'])]
class Member extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['name', 'position', 'bio'];

    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image != 'default.png' ? asset('storage/' . $this->image) : asset('admin_assets/media/admin/default.png'),
        );

    }//end of get ImagePath Attribute

    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($value) => now()->parse($value)->format('Y-m-d'));

    }//end of get createdAt Attribute

    protected static function booted(): void
    {
        static::addGlobalScope(new OrderScope);

        if(!request()->is('*members*')) static::addGlobalScope(new StatusScope);

    }//end of Global Scope

}//end of model
