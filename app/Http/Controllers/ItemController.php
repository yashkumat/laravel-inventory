<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Bill;
use App\Models\Vendor;
use App\Models\VendorBill;



class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inventory(){
        $all_items = Item::inRandomOrder()->get();
        $vendors = Vendor::all();
        return view('inventory.index', ['items'=>$all_items, 'vendors' => $vendors]);
    }

    public function addItem(){
        $vendors = Vendor::all();
        return view('inventory.addItem', ['vendors'=>$vendors]);
    }

    

    public function storeItem(Request $request){
        
        $validate = $this->validate($request, [
            'brand' => 'nullable',
            'name' => 'required|max:255',
            'cost_price' => 'required|numeric|gt:0',
            'selling_price' => 'required|numeric|gt:0',
            'expense' => 'numeric|gt:0',
            'size' => 'required',
            'quantity' => 'required|required|numeric|gt:0',
            'storage' => 'nullable',
            'vendor' => 'required',
            'balance' => 'required|nullable',
            'total' => 'required|nullable',
            'details' => 'nullable'
        ]);

        if($validate){
            $item = Item::create([
                'brand' => $request->brand,
                'name' => $request->name,
                'cost_price' => $request->cost_price,
                'selling_price' => $request->selling_price,
                'expense' => $request->expense,
                'size' => $request->size,
                'quantity' => $request->quantity,
                'storage' => $request->storage,
                'details' => $request->details,
            ]);

            $vendorBill = VendorBill::create([
                'vendor_id' => $request->vendor,
                'item_id' => $item->id,
                'balance' => $request->balance,
                'total' => $request->total
            ]);

            if($item){
                return redirect()->route('inventory');
            }
        }
        
    }

    public function editItem(Item $item){
        return view('inventory.editItem', ['item' => $item]);
    }

    public function updateItem(Request $request, Item $item){
        $validate = $this->validate($request, [
            'brand' => 'nullable',
            'name' => 'required|max:255',
            'cost_price' => 'required|numeric|gt:0',
            'selling_price' => 'required|numeric|gt:0',
            'expense' => 'required|numeric|gt:0',
            'size' => 'nullable',
            'quantity' => 'required|numeric|gt:0',
            'storage' => 'nullable',
            'details' => 'nullable'
        ]);

        if($validate){
            $updatedItem = $item->update([
                'brand' => $request->brand,
                'name' => $request->name,
                'cost_price' => $request->cost_price,
                'selling_price' => $request->selling_price,
                'expense' => $request->expense,
                'size' => $request->size,
                'quantity' => $request->quantity,
                'storage' => $request->storage,
                'details' => $request->details,
            ]);

            if($updatedItem){
                return redirect()->route('inventory');
            }
        }
    }

    public function deleteItem(Item $item){
        $result = $item->update([
            'visibility' => !$item->visibility
        ]);

        if($result){
            return redirect()->route('inventory');
        }
    }

    public function search_item(Request $request){
        $item = Item::where('name', 'LIKE', $request->search)->get();
        $vendors = Vendor::all();
        return view('inventory.search_page', ['items'=>$item, 'vendors' => $vendors]);
    }

    public function addItemToInventory(Request $request, Item $item){
        $updatedItem = $item->update([
            'quantity' => $item->quantity + $request->quantity,
            'cost_price' => $request->cost_price,
            'selling_price' => $request->selling_price,
        ]);

        $vendorBill = VendorBill::create([
            'vendor_id' => $request->vendor,
            'item_id' => $item->id,
            'balance' => $request->balance,
            'total' => $request->total
        ]);
        return redirect()->route('inventory');
    }

}
