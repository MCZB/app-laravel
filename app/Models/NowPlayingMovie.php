<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NowPlayingMovie extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', // Adicione 'id' à lista de atributos em massa
        'genre_ids',
        'original_language',
        'original_title',
        'overview',
        'popularity',
        'poster_path',
        'backdrop_path',
        'release_date',
        'title',
        'video',
        'vote_average',
        'vote_count',
    ];

}

