<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'brand_id';

    protected $fillable = [
        'brand_name',
        'brand_image',
        'rating',
        'country_codes',
    ];
}
