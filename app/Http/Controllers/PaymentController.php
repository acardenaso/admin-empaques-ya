<?php

namespace App\Http\Controllers;
use App\Commune;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('market')->get();
        return $payments;
    }

    public function store(Request $request)
    {
        return Payment::create([
        'market_id'=> $request['market_id'],
        'pay_date'=> $request['pay_date'],
        'pay_amount'=> $request['pay_amount'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $payments = Payment::findOrFail($id);
        $payments->update($request->all());
    }

    
    public function destroy($id)
    {
        $payments = Payment::findOrFail($id);
        $payments->delete();
    }
}
