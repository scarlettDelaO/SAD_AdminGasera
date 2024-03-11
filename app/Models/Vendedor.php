<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    protected $fillable=['nombre','apPaterno','apMaterno',
    'fechaN','email','telefono','nss','direccion'];
}
