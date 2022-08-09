<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\VendorBill;


class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'name',
        'cost_price',
        'selling_price',
        'expense',
        'size',
        'storage',
        'quantity',
        'details',
        'visibility'
    ];

    public function vendorBills()
    {
        return $this->hasMany(VendorBill::class);
    }
}
