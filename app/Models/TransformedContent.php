<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransformedContent extends Model
{
    protected $fillable = [
        'transformed_content',
    ];

    protected $casts = [
        'transformed_content' => 'array',
    ];
    
    protected $table = 'transformed_contents';
}
