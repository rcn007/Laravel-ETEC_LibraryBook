<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryBook extends Model
{
    protected $fillable = [
        'title',
        'author',
        'category',
        'price',
        'quantity',
        'publish_year',
        'image'
    ];
}