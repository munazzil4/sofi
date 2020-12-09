<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'isbn', 
		'title',
		'price',
		'description',
		'filename',
		'seourl',
    ];
}
