<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback', 'user_id', 'handphone_id'
    ];

    /**
     * Get the user that owns the StatusChecks
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the handphone that owns the StatusChecks
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function handphone(): BelongsTo
    {
        return $this->belongsTo(handphones::class, 'handphone_id', 'id');
    }
}
