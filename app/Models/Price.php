<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PriceDetail;

class Price extends Model
{
    use HasFactory;
    public function detail()
    {
        return $this->belongsTo(PriceDetail::class);
    }
}
