<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'image',
    ];

    /**
     * Get the image URL.
     *
     * @param  string  $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return ($value) ? Storage::url($value) : $value;
    }

    /**
     * Set the image attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setImageAttribute($value)
    {
        if (is_file($value)) {
            $this->attributes['image'] =  $value->store('uploads/Posts');
        }
    }

    /**
     * Get the user that owns the Post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
