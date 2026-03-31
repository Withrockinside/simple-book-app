<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Laravel 13 introduced Fillable as PHP attribute so we use it as the new 'standard' way
#[Fillable([
    'title', 
    'publisher', 
    'author', 
    'genre', 
    'book_publication', 
    'word_count', 
    'price_usd',
])]
class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'book_publication' => 'date',
        'word_count' => 'integer',
        'price_usd' => 'decimal:2', // To ensure 2 decimal without trailing zeroes
    ];
}
