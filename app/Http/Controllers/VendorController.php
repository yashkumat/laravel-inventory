<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Item;
use App\Models\VendorBill;


class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $vendors = Vendor::all();
        return view('vendor.index', ['vendors' => $vendors]);
    }

    public function addVendor(){
        return view('vendor.addVendor');
    }

    public function storeVendor(Request $request){
        $validate = $this->validate($request, [
            'name' => 'required|max:255',
            'number' => 'required|digits:10'
        ]);

        if($validate){
            $vendor = Vendor::create([
                'name' => $request->name,
                'number' => $request->number,
                'address' => $request->address,
                'pinCode' => $request->pinCode,
                'bankName' => $request->bankName,
                'accountNumber' => $request->accountNumber,
                'accountName' => $request->accountName,
                'ifscCode' => $request->ifscCode,
                'branch' => $request->branch,
                'gstNumber' => $request->gstNumber,
                'phonePeNumber' => $request->phonePeNumber,
            ]);

            if($vendor){
                return redirect()->route('vendor');
            }
        }
    }

    public function vendorDetails($id){
        $vendor = Vendor::find($id);
        $vendor_bills = VendorBill::where('vendor_id', $id)->with('item')->get();
        return view('vendor.vendorDetails', ['vendor'=>$vendor, 'bills'=>$vendor_bills]);
    }

    public function vendorBills(){
        $vendor_bills = VendorBill::with("vendor")->get();
        return view('vendor.vendorBills', [ 'bills'=>$vendor_bills]);
    }

    public function vendorItemInfo($id){
        $item = Item::where('id', $id)->get();
        $vendors = Vendor::all();
        return view('inventory.search_page', ['items'=>$item, 'vendors' => $vendors]);
    }

    public function editVendor($id){
        $vendor = Vendor::find($id);
        return view('vendor.editVendor', ['vendor'=>$vendor]);
    }

    public function updateVendor($id, Request $request){

        $validate = $this->validate($request, [
            'name' => 'required|max:255',
            'number' => 'required|digits:10',
        ]);

        if($validate){
            $vendor = Vendor::find($id);

            $updatedVendor = $vendor->update([
                'name' => $request->name,
                'number' => $request->number,
                'address' => $request->address,
                'pinCode' => $request->pinCode,
                'bankName' => $request->bankName,
                'accountNumber' => $request->accountNumber,
                'accountName' => $request->accountName,
                'ifscCode' => $request->ifscCode,
                'branch' => $request->branch,
                'gstNumber' => $request->gstNumber,
                'phonePeNumber' => $request->phonePeNumber,
            ]);
    
            if($updatedVendor){
                return redirect()->route('vendor', $vendor->id);
            }
        }
        
    }

    public function clearVendorBill($id){
        $bill = VendorBill::find($id);
        $bill->balance = 0;
        $bill->save();
        return redirect()->route('vendorDetails', $bill->vendor_id);
    }
}
