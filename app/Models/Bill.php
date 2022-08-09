<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'total',
        'pending',
        'gst_number',
        'mode_of_payment'
    ];

    
}
