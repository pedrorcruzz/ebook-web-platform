<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class UserAuthor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user_author';

    protected $fillable = [
        'username',
        'email',
        'password',
        'description',
        'status',
        'profile_picture'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'user_author_id');
    }
}
