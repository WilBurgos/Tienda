<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ordenes;
use App\Clientes;
use App\Alimentos;
use App\OrdenAlimentos;
use App\Ventas;

class OrdenesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes   = Clientes::select('id','nombre','primerAp','segundoAp')->get();
        $comidas    = Alimentos::where('tipoComida','COMIDA')->select('id','nombre')->get();
        $bebidas    = Alimentos::where('tipoComida','BEBIDA')->select('id','nombre')->get();
        return view('ordenes',['clientes'=>$clientes,'comidas'=>$comidas,'bebidas'=>$bebidas]);
    }

    public function json_ordenes()
    {
        $ordenes = Ordenes::with(['ordenAlimento.alimento','mesero','cliente'])->where('diaOrden',date('Y-m-d'))->get();
        return response()->json($ordenes);
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
            if( $request->idCliente == null ){
                $newCliente = Clientes::create([
                    'nombre'        => $request->nombre,
                    'primerAp'      => $request->primerAp,
                    'segundoAp'     => $request->segundoAp,
                    'numVisitas'    => 1
                ]);
                $idCliente = $newCliente->id;
            }else{
                $visitas    = Clientes::select('numVisitas')->where('id',$request->idCliente)->first();
                $sumaVisitas = $visitas->numVisitas + 1;
                $updCliente = Clientes::find($request->idCliente)->update([
                    'numVisitas'    => $sumaVisitas
                ]);
                $idCliente = $request->idCliente;
            }
            $newOrden = Ordenes::create([
                'idMesero'      => auth()->user()->id,
                'idCliente'     => $idCliente,
                'folioOrden'    => time(),
                'numMesa'       => $request->numeroMesa,
                'diaOrden'      => date('Y-m-d'),
                'totalOrden'    => 0
            ]);
            foreach ($request->idComida as $key => $value) {
                $newComida = OrdenAlimentos::create([
                    'idOrden'       => $newOrden->id,
                    'idAlimento'    => $request->idComida[$key],
                    'cantidad'      => $request->cantidadComida[$key]
                ]);
            }
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
            if( $request->actualizacion == 'datos' ){
                $ordenAlimentos = OrdenAlimentos::where('idOrden',$id)->get();
                $countOA = count($ordenAlimentos->toArray());
                $suma=0;
                foreach ($request->idComida as $key => $value) {
                    if($suma < $countOA){
                        $oA = OrdenAlimentos::where('id',$ordenAlimentos[$key]->id)->first();
                        if( $oA!=null ){
                            $updOA = OrdenAlimentos::find($ordenAlimentos[$key]->id)->update([
                                'idAlimento'    => $request->idComida[$key],
                                'cantidad'      => $request->cantidadComida[$key]
                            ]);
                        }
                    }else{
                        $newComida = OrdenAlimentos::create([
                            'idOrden'       => $id,
                            'idAlimento'    => $request->idComida[$key],
                            'cantidad'      => $request->cantidadComida[$key]
                        ]);
                    }
                    $suma=$suma+1;
                }
            }else{
                switch ($request->estatusOrden) {
                    case 'CONSUMIENDO':
                        $updOrden = Ordenes::find($id)->update([
                            'estatusOrden'      => $request->estatusOrden
                        ]);
                        break;
                    case 'CERRADA':
                        $ordenAlimentos = OrdenAlimentos::with('alimento')->where('idOrden',$id)->get();
                        $total = 0;
                        foreach ($ordenAlimentos as $ordenAlimento) {
                            $total = $total + ($ordenAlimento->alimento->precio*$ordenAlimento->cantidad);
                        }
                        $updOrden = Ordenes::find($id)->update([
                            'estatusOrden'      => $request->estatusOrden,
                            'totalOrden'        => $total
                        ]);
                        break;
                    case 'PAGADA':
                        $updOrden = Ordenes::find($id)->update([
                            'estatusOrden'      => $request->estatusOrden
                        ]);
                        $newVenta = Ventas::create([
                            'idOrden'       => $id,
                            'diaVenta'      => date('Y-m-d'),
                            'totalVenta'    => $request->totalOrden
                        ]);
                        break;
                    default:
                        return redirect()->action('OrdenesController@index');
                        break;
                }
            }
            \DB::commit();
            $mensaje = 'Los datos se guardaron correctamente';
        } catch (\Exception $e) {
            $mensaje = $e->getMessage();
            \DB::rollback();
        }
        return response()->json($mensaje);
    }

    public function pagarOrden(Request $request)
    {
        $ordenAlimentos = OrdenAlimentos::with('alimento')->where('idOrden',$request->id)->get();
        $total = 0;
        foreach ($ordenAlimentos as $ordenAlimento) {
            $total = $total + ($ordenAlimento->alimento->precio*$ordenAlimento->cantidad);
        }
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
