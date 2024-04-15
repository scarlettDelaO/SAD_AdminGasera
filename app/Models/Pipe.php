<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Pipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'salesperson_id',
        'capacity',
        'niv',
        'brand',
        'model',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
