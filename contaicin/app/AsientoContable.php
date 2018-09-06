<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cuenta;
use App\DetalleAsientoContable;

class AsientoContable extends Model
{
  protected $table = 'asientos_contables';

  protected $fillable = [
    'glosa', 'fecha'
  ];
  public static function venta(){
    $cuentas_ingresos = Cuenta::where('tipo_cuenta_id', 6)->get();
    $ventas = 0;

    foreach ($cuentas_ingresos as $cuenta) {
      $ventas += $cuenta->sumHaber();
    }

    return $ventas;
  }

  public static function costo_venta(){
    $costos_id = static::where('glosa', 'like', 'venta%')->get()->pluck('id');
    $activos = Cuenta::where('tipo_cuenta_id', [1,2])->get()->pluck('id');
    $costo_venta = 0;

    foreach ($costos_id as $id) {
      $costo_venta += DetalleAsientoContable::whereIn('cuenta_id', $activos)->get()->where('asiento_contable_id', $id)->pluck('haber')->sum();
    }

    return $costo_venta;
  }

  public static function gasto(){
    $cuentas_gastos =Cuenta::where('tipo_cuenta_id', 7)->get();
    $gastos = 0;

    foreach ($cuentas_gastos as $cuenta) {
      $gastos += $cuenta->sumDebe();
    }

    return $gastos;
  }

}
