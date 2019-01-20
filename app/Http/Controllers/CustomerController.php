<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    //
    public function index() {
        $customers = Customer::all();

        return view('customers.index', compact('customers'));
    }

    public function store () {

        $request = request();
        $request->validate([
            'firstname' => 'bail|required|string',
            'lastname' => 'bail|required|string'
        ]);

        $customer = new Customer();

        $customer->salutation_id = 1;
        $customer->firstname     = request('firstname');
        $customer->lastname      = request('lastname');
        $customer->company       = '';
        $customer->street        = 'Ganghofestr.';
        $customer->housenumber   = '54';
        $customer->city          = 'Kolbermoor';
        $customer->zip           = '83059';
        $customer->country_id    = 'de';

        $customer->save();

        return redirect('/customers');
    }
}
