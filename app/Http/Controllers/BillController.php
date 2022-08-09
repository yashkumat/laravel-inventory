<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Bill;


class BillController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function addToBill(Request $request, Item $item){

        if($request->quantity <= $item->quantity)
        {

        $validate = $this->validate($request, [
            'quantity' => 'required|numeric|gt:0',
        ]);

        $bill = session()->get('bill');

        if(!$bill){
            $bill = [
                $item->id => [
                    'name' => $item->name,
                    'price' => $item->selling_price,
                    'quantity' => $request->quantity,
                    'available' => $item->quantity
                ]
            ];
            session()->put('bill', $bill);
            $item->update([
                'quantity' => $item->quantity - $request->quantity,
            ]);
            return redirect()->route('bill');
        }
        
        if(isset($bill[$item->id])){
            $bill[$item->id]['quantity'] += $request->quantity;
            $item->update([
                'quantity' => $item->quantity - $request->quantity,
            ]);
            session()->put('bill', $bill);
            return redirect()->route('bill');
        }

        $bill[$item->id] = [
            'name' => $item->name,
            'price' => $item->selling_price,
            'quantity' => $request->quantity,
            'available' => $item->quantity
        ];
        session()->put('bill', $bill);
        $item->update([
            'quantity' => $item->quantity - $request->quantity,
        ]);
        return redirect()->route('bill');

        }else{
            return redirect()->back();
        }

    }

    public function index(){
        $bill_number = count(Bill::all()) +1;
        return view('billing.index', ['bill_number'=>$bill_number]);
    }

    public function removeFromBill($id){
        $bill = session()->get('bill');

        if(isset($bill[$id])){
            $item = Item::find($id);
            $item->update([
                'quantity' => $item->quantity + $bill[$id]['quantity']
            ]);
            unset($bill[$id]);
            session()->put('bill', $bill);
        }
        return redirect()->route('bill');

    }

    public function editQuantity(Request $request, $id){

        $bill = session()->get('bill');

        $item = Item::find($id);

        $available_quantity = $item->quantity;

        if($available_quantity >= $request->quantity){
            $validate = $this->validate($request, [
                'quantity' => 'required|numeric|gt:0',
            ]);
    
            if($validate){
                if(isset($bill[$id])){
                    $item->update([
                        'quantity' => $item->quantity + $bill[$id]['quantity'] - $request->quantity
                    ]);

                    $bill[$id]['quantity'] = $request->quantity;
                    
                    session()->put('bill', $bill);
                    return redirect()->route('bill');
                }
            }
        }else{
            return redirect()->back();
        }

        
        
    }

    public function addDiscount(Request $request){

        $validate = $this->validate($request,[
            'discount' => 'required|numeric|gte:0'
        ]);

        if($validate){
            $discount = session()->get('discount');
            $discount = $request->discount;
            session()->put('discount', $discount);
            return redirect()->route('bill');
        }

    }

    public function saveBill(Request $request){
        $validate = $this->validate($request, [
            'name' => 'required|max:255',
            'number' => 'required|numeric|digits:10',
            'total' => 'required|gt:0',
            'pending' => 'required|gte:0',
            'gst_number' => 'nullable|numeric'
        ]);

        if($validate){
            $bill = Bill::create([
                'name' => $request->name,
                'number' => $request->number,
                'total' => $request->total,
                'pending' => $request->total - $request->pending,
                'mode_of_payment' => $request->mode_of_payment,
                'gst_number' => $request->gst_number
            ]);

            if($bill){
                $request->session()->forget('bill');
                $request->session()->forget('discount');
                return redirect()->route('dashboard');
            }
        }
    }

    public function billBook(){
        $bills = Bill::all();
        return view('billing.billbook', ['bills'=>$bills]);
    }

    public function clearBill(Bill $bill){
        $update_status = $bill->update([
            'pending' => 0,
        ]);

        if($update_status){
            return redirect()->route('billBook');
        }
    }

    public function autocomplete(Request $request){
        $data = Item::where('name', 'LIKE', "%{$request->search}%") ->get();

        return response()->json($data);
    }

    // public function clear_bill(){
    //     Session::forget('bill');
    //     if(!Session::has('bill'))
    //     {
    //         return redirect()->route('dashboard');
    //     }
    // }

    public function resetBill(Request $request){

        if (session()->has('bill')) {

            $items = session()->get('bill');

            foreach($items as $id => $bill_item){
                $item = Item::find($id);
                $item->update([
                    'quantity' => $item->quantity + $bill_item['quantity']
                ]);
            }

            session()->forget('bill');
            return redirect()->route('bill');
        }
    }
}
