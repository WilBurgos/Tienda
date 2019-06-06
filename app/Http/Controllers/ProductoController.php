<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Proveedor;
use App\Producto;
use App\Alimentos;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // $proveedores = Alimentos::select('id','nombre')->get();
        //dd($proveedores);
    return view('producto'/*,['proveedores' => $proveedores]*/);
    }

    public function json_productos()
    {
        $productos = Alimentos::all();
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
        $mensaje = null;
        \DB::beginTransaction();
        try{
            $newProducto = Alimentos::create([
                'tipoComida'    => $request->tipoComida,
                'nombre'        => $request->nombre,
                'precio'        => $request->precio
            ]);
            // $newProducto = Producto::create([
            //     'idProveedor'       => $request->input('idProveedor'),
            //     'nombreProducto'    => $request->input('nombreProducto'),
            //     'estatus'           => 'ACTIVO'
            // ]);
            \DB::commit();
            $mensaje = 'Los datos se guardaron correctamente';
        } catch (\Exception $e) {
            $mensaje = $e->getMessage();
            \DB::rollback();
        }
        return response()->json($mensaje);
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
        $mensaje = null;
        \DB::beginTransaction();
        try{
            $updateProdcuto = Alimentos::find($id)->update([
                'tipoComida'    => $request->tipoComida,
                'nombre'        => $request->nombre,
                'precio'        => $request->precio
            ]);
            // $updateProdcuto = Producto::find($id)->update([
            //     'idProveedor'       => $request->input('idProveedor'),
            //     'nombreProducto'    => $request->input('nombreProducto'),
            //     'estatus'           => $request->input('estatus'),
            // ]);
            \DB::commit();
            $mensaje = 'Los datos se guardaron correctamente';
        } catch (\Exception $e) {
            $mensaje = $e->getMessage();
            \DB::rollback();
        }
        return response()->json($mensaje);
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
