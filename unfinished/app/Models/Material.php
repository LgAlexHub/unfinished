<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $fillable = [
        'name',
        'material_type_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo <MaterialType, $this>
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(MaterialType::class);
    }

    /**
     * @return HasMany <MaterialState, $this>
     */
    public function states(): HasMany
    {
        return $this->hasMany(MaterialState::class);
    }

    /**
     * @return BelongsToMany <Member, $this>
     */
    public function borrowers(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'material_member')
            ->withPivot(['borrowed_at', 'returned_at']);
    }

    /**
     * @return MaterialState|null
     */
    public function currentState(): ?MaterialState
    {
        return $this->states()->orderBy('version', 'desc')->first();
    }
}
