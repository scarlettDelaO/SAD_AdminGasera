<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\PriceDetail;

class Sale extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class, 'pay_id');
    }

    public function detail()
    {
        return $this->belongsTo(PriceDetail::class);
    }

    protected $fillable = [
        'customer_id',
        'detail_id',
        'date',
        'quantity',
        'discount',
        'pay_id',
        'total',
    ];


}
