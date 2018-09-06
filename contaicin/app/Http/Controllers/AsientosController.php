<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\AsientoContable;
use App\DetalleAsientoContable;

class AsientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $asientos = AsientoContable::all();

      return view('asiento_contable.inicio', compact('asientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuentas = Cuenta::all();
        $select = "<select class=\"form-control\" name=\"tipo_cuenta[]\" required><option selected disabled>Seleccione una cuenta</option>";
        foreach ($cuentas as $cuenta) {
          $select .= "<option value=\"".$cuenta->id."\">".$cuenta->nombre."</option>";
        }
        $select .= "</select>";

        return view('asiento_contable.nuevo', compact('select'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if ($request->ajax()) {

        $num_asientos = count($request->tipo_cuenta);
        if($num_asientos != 0){
          $asiento = new AsientoContable;
          $asiento->fecha = $request->fecha;
          $asiento->glosa = $request->glosa;
          $rs = $asiento->save();

          if ($rs) {
            for ($i=0; $i < $num_asientos ; $i++) {
              $detalle_asiento = new DetalleAsientoContable;

              $detalle_asiento->asiento_contable_id = $asiento->id;
              $detalle_asiento->cuenta_id = $request->tipo_cuenta[$i];
              $detalle_asiento->debe = $request->debe[$i];
              $detalle_asiento->haber = $request->haber[$i];

              $rs = $detalle_asiento->save();
            }
            return response()->json($rs);
          }
        }
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($asientos_contable)
    {
        $asiento = AsientoContable::find($asientos_contable);
        $detalle_asiento = DetalleAsientoContable::all()->where('asiento_contable_id',$asiento->id);
        return view('asiento_contable.ver', compact('asiento','detalle_asiento'));
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
