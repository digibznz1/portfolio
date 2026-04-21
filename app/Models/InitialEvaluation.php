<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StatusScope;
use App\Models\Scopes\OrderIndexScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['question', 'answer', 'description', 'status', 'admin_id', 'category_id', 'organization_type_id'])]
class InitialEvaluation extends Model
{
    use HasFactory, SoftDeletes;

    public function selfEvaluations(): BelongsToMany
    {
        return $this->belongsToMany(SelfEvaluation::class, 'initial_evaluation_self_evaluations')->withTimestamps();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function organizationType(): BelongsTo
    {
        return $this->belongsTo(OrganizationType::class);
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($value) => now()->parse($value)->format('Y-m-d'));

    }//end of get createdAt Attribute

    protected static function booted(): void
    {
        static::addGlobalScope(new OrderIndexScope);

        if(!request()->is('*initial_evaluations*')) static::addGlobalScope(new StatusScope);

    }//end of Global Scope

}//end pf model