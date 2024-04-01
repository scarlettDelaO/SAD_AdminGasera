<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customer;
use App\Models\Statu;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'date', 'quantity', 'address', 'statu_id'];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function status()
    {
        return $this->belongsTo(Statu::class, 'statu_id');
    }
}
