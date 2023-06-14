<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Feedback;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'grade',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get all of the handphones for the Users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function owner(): HasMany
    {
        return $this->hasMany(handphones::class, 'owner', 'id');
    }

    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function borrower(): HasOne
    {
        return $this->hasOne(handphones::class, 'borrower', 'id');
    }

    /**
     * Get all of the status_check for the Users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedback(): HasMany
    {
        return $this->hasMany(Feedback::class, 'user_id', 'id');
    }
}
