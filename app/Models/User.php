<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements JWTSubject
{
    use  HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'email_verified_at',
        'image',
        'password',
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
    ];

    /**
     * Set the user's password.
     * 
     * Hash the password when setting it.
     * 
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Get the user's image.
     * 
     * If the image is a file, return its URL.
     * Otherwise, return the image string.
     * 
     * @param  string  $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return ($value) ? Storage::url($value) : $value;
    }

    /**
     * Set the user's image.
     * 
     * If the image is a file, store it and set the image attribute to the file path.
     * 
     * @param  mixed  $value
     * @return void
     */
    public function setImageAttribute($value)
    {
        if (is_file($value)) {
            $this->attributes['image'] =  $value->store('uploads/User');
        }
    }

    /**
     * Get the user's posts.
     * 
     * Return a HasMany relationship of all the posts made by the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * 
     * Return the user's ID as the identifier.
     * 
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**

     * Return a key value array, containing any custom claims to be added to the JWT.
     * 
     * Return an empty array by default.
     * 
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
