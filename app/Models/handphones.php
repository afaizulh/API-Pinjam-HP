<?php

namespace App\Models;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class handphones extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_name', 'status', 'image', 'owner', 'borrower'
    ];

    /**
     * Get the status_check associated with the handphones
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function feedback(): HasOne
    {
        return $this->hasOne(Feedback::class, 'handphone_id', 'id');
    }

    /**
     * Get the owner that owns the handphones
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pemilik(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner', 'id');
    }

    /**
     * Get the user that owns the handphones
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'borrower', 'id');
    }

    
}
