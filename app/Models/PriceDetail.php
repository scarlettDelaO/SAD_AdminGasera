<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'netPrice',
        'iva',
        'salePrice',
        'aggregate'
    ];

}
