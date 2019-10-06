<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Market;
use App\Commune;

class MarketController extends Controller
{
    public function index()
    {
        $communes = Commune::all();
        $markets = Market::with('commune')->get();
        return $markets;
    }
    
    public function store(Request $request)
    {
        $messages = [
            'rut.unique' => 'Este rut ya se encuentra registrado',
   
            
        ];    
        $rules = [
            'commune_id' => 'required',
        ];

        $this->validate($request, $rules,$messages);

        return Market::create([
        'commune_id'=> $request['commune_id'],
        'name'=> $request['name'],
        'address'=> $request['address'],
        'max_packing'=> $request['max_packing'],
        'payment_day'=> $request['payment_day'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $markets = Market::findOrFail($id);
        $markets->update($request->all());
    }

    
    public function destroy($id)
    {
        $markets = Market::findOrFail($id);
        $markets->delete();
    }

}
