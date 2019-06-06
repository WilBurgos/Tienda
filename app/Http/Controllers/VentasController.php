<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ventas;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ventas');
    }

    public function json_ventas()
    {
        //$productos = Producto::with('proveedor')->get();
        //return response()->json($productos);
        $ventas = Ventas::with(['orden.mesero','orden.ordenAlimento','orden.cliente'])->get();
        //dd($ventas);
        return response()->json($ventas);
    }

    public function json_ventasFechas(Request $request)
    {
        //dd($request->all());


        //$productos = Producto::with('proveedor')->get();
        //return response()->json($productos);
        $ventas = Ventas::with(['orden.mesero','orden.ordenAlimento','orden.cliente'])->whereBetween('diaVenta', [$request->fechaInicial, $request->fechaFinal])->get();
        //dd($ventas);
        return response()->json($ventas);
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
        //
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
