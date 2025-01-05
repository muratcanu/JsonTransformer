<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElementMapping extends Model
{
    protected $fillable = [
        'elementor_type',
        'frontend_type',
        'settings_mapper',
    ];
    
    protected $table = 'element_mappings';
}
