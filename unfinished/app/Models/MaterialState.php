<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialState extends Model
{
    protected $fillable = [
        'material_id',
        'version',
        'state',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo <this, Material>
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
