<?php

namespace Base\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {

    protected $table = 'blogs';

    protected $fillable = [
        'slug',
        'title',
        'description',
        'published_on'
    ];
	
}

