<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'fullname',
        'photo_profile',
        'address',
        'email',
        'password',
        'bio'
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
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(comments::class, 'user_id', 'id');
    }
    /**
     * Get all of the albums for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function albums(): HasMany
    {
        return $this->hasMany(albums::class, 'user_id', 'id');
    }
    /**
     * Get all of the likes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(likes::class, 'user_id', 'id');
    }
    /**
     * Get all of the photos for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos(): HasMany
    {
        return $this->hasMany(photos::class, 'user_id', 'id');
    }
    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
    */
    public function sendPasswordResetNotification($token): void
    {
        // urlencode untuk mengganti karakter yang masuk ke url menjadi lebih aman.
        $url = 'http://127.0.0.1:8000/reset-password/'.$token.'?email='.urlencode($this->email);
        $this->notify(new ResetPasswordNotification($url));
    }
}
