<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


use App\Models\Item;
use App\Models\Bill;
use App\Models\Vendor;
use App\Models\VendorBill;
use App\Models\User;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }    

    public function dashboard(){
        $all_items = Item::where('visibility','1')->get();
        $low_quantity = Item::where('quantity', '=', 0 )->where('visibility','1')->get();
        $low_quantity_item = $low_quantity->count();
        $total_items = count($all_items);

        $all_bill = Bill::all();
        $all_customer = count($all_bill);

        $pending_bill = Bill::where('pending', '>', 0)->get();
        $pending_bill_count = count($pending_bill);

        $total_sale = Bill::sum('total');
        $debt_amount = VendorBill::sum('balance');
        $credit_amount = Bill::sum('pending');
        $total_purchase = VendorBill::sum('total');
        $total_profit = $total_sale - $total_purchase + $credit_amount - $debt_amount;
        
        return view('dashboard.dashboard', ['total_items' => $total_items, 'low_quantity' => $low_quantity_item, 'pending_bill' => $pending_bill_count, 'all_customer' => $all_customer, 'total_sale' => $total_sale, 'debt_amount' => $debt_amount, 'credit_amount' => $credit_amount, 'total_purchase' => $total_purchase, 'total_profit' => $total_profit]);
    }

    public function profile(){
        $users = User::all();
        return view('dashboard.profile', ['users'=>$users]);
    }

    public function toggleActive($id){
        $user = User::find($id);
        $user->active_status = !$user->active_status;
        $user->save();
        return redirect()->route('profile');
    }

    public function toggleAdmin($id){
        $user = User::find($id);
        $user->update(['isAdmin' => !$user->isAdmin]);
        return redirect()->route('profile');
    }

    public function userRegisteration(){
        return view('dashboard.register');
    }

    public function registerUser(Request $request){
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if($validate){
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'isAdmin' => isset($request['isAdmin']) ? '1' : '0',
                'password' => Hash::make($request['password']),
            ]);

            if($user){
                return redirect()->route('profile');
            }
        }
    }
}

