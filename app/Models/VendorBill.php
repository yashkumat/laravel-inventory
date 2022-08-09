<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Vendor;
use App\Models\Bill;


class VendorBill extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'item_id',
        'balance',
        'total',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
