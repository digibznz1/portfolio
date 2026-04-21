<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Scopes\OrderIndexScope;
use App\Models\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Appends;

#[Fillable(['name', 'flag', 'code', 'dir', 'default', 'status'])]
#[Appends(['image_path'])]
class Language extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function imagePath(): Attribute
    {
        if ($this->code == 'ar') {

            $flagPath = asset('admin_assets/images/flags/saudi-arabia.svg');

        } elseif($this->code == 'en') {
            
            $flagPath = asset('admin_assets/images/flags/united-states.svg');
            
        } else {

            $flagPath = asset('storage/' . $this->flag);
        }

        return Attribute::make(get: fn () => $flagPath);

    }//end of get ImagePath Attribute

    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($value) => now()->parse($value)->format('Y-m-d'));

    }//end of get createdAt Attribute

    protected static function booted(): void
    {
        static::addGlobalScope(new OrderIndexScope);

        if(!request()->is('*languages*')) static::addGlobalScope(new StatusScope);

    }//end of Global Scope

}//end of model