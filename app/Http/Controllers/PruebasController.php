<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\proveedorRequest;

use App\Proveedor;
use App\Producto;

class PruebasController extends Controller
{
    protected $redirectTo = '/pruebas';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estatus = array(
            null                  => 'SELECCIONE UNA OPCIÓN',
            'ACTIVO'        => 'ACTIVO',
            'INACTIVO'  => 'INACTIVO'
        );
        return view('pruebas',compact('estatus'));
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
    public function store(request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'compania' => 'required',
            'direccion' => 'required',
        ]);
        $newProveedor = Proveedor::create([
            'compania'  => $request->input('compania'),
            'direccion' => $request->input('direccion'),
            'telefono'  => $request->input('telefono'),
            'correo'    => $request->input('correo'),
            'estatus' => 'ACTIVO'
        ]);
        
        return response()->json($newProveedor)
                            ->withCallback($request->all());
        //return response()->json($newProveedor)
        //                ?: redirect($this->redirectTo);
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
        //
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
