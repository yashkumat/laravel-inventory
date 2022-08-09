<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\VendorBill;


class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'address',
        'pinCode',
        'bankName',
        'accountNumber',
        'accountName',
        'ifscCode',
        'branch',
        'gstNumber',
        'phonePeNumber',
    ];

    public function vendorBills()
    {
        return $this->hasMany(VendorBill::class);
    }
}
