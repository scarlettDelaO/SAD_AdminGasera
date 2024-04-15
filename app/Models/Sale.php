<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_detail',
        'id_customers',
        'date',
        'quantity',
        'discount',
        'id_pay',
        'total'
    ];

}
