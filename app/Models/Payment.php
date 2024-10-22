<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'payer_name',
        'payer_email',
        'payer_phone',
        'payer_address',
        'amount',
        'method',
        'status',
    ];
}
