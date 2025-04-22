<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';

    protected $fillable = [
        'user_author_id',
        'title',
        'genre',
        'isbn',
        'publication_date',
        'description',
        'cover_image',
        'status'
    ];

    public function author()
    {
        return $this->belongsTo(UserAuthor::class, 'user_author_id');
    }
}
