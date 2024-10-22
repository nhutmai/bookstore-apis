<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        return Payment::all();
    }
    public function show($id){
        return Payment::find($id);
    }

    public function store(Request $request){
        $request->validate([
            'payer_name'=> 'required',
            'payer_email'=> 'required',
            'payer_phone'=> 'required',
            'method'=> 'required',
            'status'=> 'required',
            'amount'=> 'required|numeric'
        ]);
        return Payment::create($request->all());
    }
}
