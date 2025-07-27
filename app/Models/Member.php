<?php

namespace App\Models;

use Database\Factories\MemberFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'joined_at',
        'is_minor',
        'created_at',
        'updated_at',
    ];

    protected $visible = [
        'id',
        'first_name',
        'last_name',
        'joined_at',
        'is_minor',
        'created_at',
        'updated_at',
    ];

    /**
     * @return hasMany<Contact, $this>
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * @return BelongsToMany <Material, $this>
     */
    public function borrowed(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'material_member')
            ->withPivot(['borrowed_at', 'returned_at']);
    }

    protected static function newFactory() : Factory {
        return new MemberFactory();
    }
}
