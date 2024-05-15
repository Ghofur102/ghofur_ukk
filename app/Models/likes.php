<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class likes extends Model
{
    use HasFactory;
    protected $table = 'likes';
    protected $fillable = [
       'photo_id',
       'user_id'
    ];
    /**
     * Get the user that owns the likes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    /**
     * Get the photo that owns the likes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo(): BelongsTo
    {
        return $this->belongsTo(photos::class, 'photo_id', 'id');
    }
    public function count_photo()
    {
        return $this->photo()->count();
    }
}
