<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use App\Http\Resources\ServerCollection;
use Illuminate\Support\Facades\Hash;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servers = Server::all();
        return $servers;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
      
            'provider.max' => 'Maximo 20 caracteres',
            
        ];

        $this->validate($request,[
  
        'provider' => 'required|max:20',
        'start_contract' => 'required',
        'period' => 'required|max:5',
        'ram' => 'required|max:5',
        'storage' => 'required|max:5',
        'cores' => 'required|max:5'
        ],$messages);
 

        return Server::create([
        'name'=> $request['name'],
        'provider'=> $request['provider'],
        'start_contract'=> $request['start_contract'],
        'period'=> $request['period'],
        'storage'=> $request['storage'],
        'ram'=> $request['ram'],
        'cores'=> $request['cores'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $servers = Server::findOrFail($id);
        $servers->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servers = Server::findOrFail($id);
        $servers->delete();
    }
}
