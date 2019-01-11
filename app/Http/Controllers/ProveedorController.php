<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\proveedorRequest;

use App\Proveedor;
use App\Producto;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proveedor');
    }

    public function json_proveedores()
    {
        $proveedores = Proveedor::get();
        return response()->json($proveedores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(proveedorRequest $request)
    {
        $newProveedor = Proveedor::create([
            'compania' => $request->input('compania'),
            'estatus' => 'ACTIVO'
        ]);

        return response()->json($newProveedor);
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
    public function update(proveedorRequest $request, $id)
    {
        $idProveedor = $request->input('id');
        $updateProveedor = Proveedor::find($idProveedor)->update([
            'compania'  => $request->input('compania'),
            'estatus'   => $request->input('estatus')
        ]);
        
        return response()->json($updateProveedor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
