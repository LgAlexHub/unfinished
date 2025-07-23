<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'joined_at',
        'is_minor',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo<this, Contact>
     */
    public function contact(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * @return BelongsToMany <this, Member>
     */
    public function borrowed(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'material_member')
            ->withPivot(['borrowed_at', 'returned_at']);
    }
}
