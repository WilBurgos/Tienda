<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Proveedor;
use App\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::where('estatus','ACTIVO')->select('id','compania')->get();
        //dd($proveedores);
        return view('producto',['proveedores' => $proveedores]);
    }

    public function json_productos()
    {
        $productos = Producto::with('proveedor')->get();
        return response()->json($productos);
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
    public function store(Request $request)
    {
        $newProducto = Producto::create([
            'idProveedor'       => $request->input('idProveedor'),
            'nombreProducto'    => $request->input('nombreProducto'),
            'estatus'           => 'ACTIVO'
        ]);

        return response()->json($newProducto);
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
        $idProducto = $request->input('id');
        $updateProdcuto = Producto::find($idProducto)->update([
            'idProveedor'       => $request->input('idProveedor'),
            'nombreProducto'    => $request->input('nombreProducto'),
            'estatus'           => $request->input('estatus'),
        ]);

        return response()->json($updateProdcuto);
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
