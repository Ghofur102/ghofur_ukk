<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class photos extends Model
{
    use HasFactory;
    protected $table = 'photos';
    protected $fillable = [
       'name_photo',
       'description_photo',
       'location_file',
       'album_id',
       'user_id',
       'count_like'
    ];
    /**
     * Get the user that owns the photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    /**
     * Get the album that owns the photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(User::class, 'album_id', 'id');
    }
    /**
     * Get all of the comments for the photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(comments::class, 'photo_id', 'id');
    }
    /**
     * Get all of the likes for the photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(likes::class, 'photo_id', 'id');
    }
    // cek apakah user yang sedang login saat ini sudah like postingan
    public function isLike()
    {
        return likes::where('user_id', Auth::user()->id)->where('photo_id', $this->id)->exists();
    }
}
