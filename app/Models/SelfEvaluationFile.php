<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StatusScope;
use App\Models\Scopes\OrderIndexScope;
use Illuminate\Database\Eloquent\Attributes\Appends;

#[Fillable(['file', 'description', 'status', 'admin_id'])]
#[Appends(['file_path'])]
class SelfEvaluationFile extends Model
{
    use HasFactory;

    protected function filePath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->file != '' ? asset('storage/' . $this->file) : asset('admin_assets/media/admin/default.png'),
        );

    }//end of get filePath Attribute

    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($value) => now()->parse($value)->format('Y-m-d'));

    }//end of get createdAt Attribute

    protected static function booted(): void
    {
        static::addGlobalScope(new OrderIndexScope);

        if(!request()->is('*self_evaluation_files*')) static::addGlobalScope(new StatusScope);

    }//end of Global Scope

}//end pf model