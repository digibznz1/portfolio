<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StatusScope;
use App\Models\Scopes\OrderIndexScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'alert_type', 'alert_value', 'alert', 'explain', 'degree', 'status', 'admin_id', 'category_id', 'organization_type_id'])]
class SelfEvaluation extends Model
{
    use HasFactory, SoftDeletes;

    public function initialEvaluations(): BelongsToMany
    {
        return $this->belongsToMany(InitialEvaluation::class, 'initial_evaluation_self_evaluations')->withTimestamps();
    }

    public function scopeOrganizationTypeJoin(Builder $query): Builder
    {
        return $query->leftJoin('organization_types', 'self_evaluations.organization_type_id', '=', 'organization_types.id')
                     ->select('self_evaluations.*', 'organization_types.name as organization_type_name');

    }//end of scope Role
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function selfEvaluationFiles(): HasMany
    {
        return $this->hasMany(SelfEvaluationFile::class);
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($value) => now()->parse($value)->format('Y-m-d'));

    }//end of get createdAt Attribute

    protected static function booted(): void
    {
        static::addGlobalScope(new OrderIndexScope);

        if(!request()->is('*self_evaluations*')) static::addGlobalScope(new StatusScope);

    }//end of Global Scope

}//end pf model