<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'member_id',
        'phone_number',
        'email',
        'created_at',
        'updated_at'
    ];

    /**
     * @return BelongsTo<this, Member>
     */
    public function contact() : BelongsTo {
        return $this->belongsTo(Member::class);
    }
}
