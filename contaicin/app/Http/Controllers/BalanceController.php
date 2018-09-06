<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoCuenta;
use App\AsientoContable;
use App\Cuenta;

class BalanceController extends Controller
{
    public function general(){
      $activos = TipoCuenta::find([1,2]);
      $pasivos = TipoCuenta::find([3,4,5]);
      $venta = AsientoContable::venta();
      $costo_venta = AsientoContable::costo_venta();
      $utilidad = $venta - $costo_venta;

      return view('balance_general', compact('activos', 'pasivos', 'utilidad'));
    }

    public function estado_resultado(){
      $venta = AsientoContable::venta();
      $costo_venta = AsientoContable::costo_venta();
      $margen = $venta - $costo_venta;
      $gastos = AsientoContable::gasto() - $costo_venta;
      $cuentas_gastos =Cuenta::where('tipo_cuenta_id', 7)->get();

      return view('estado_resultado', compact('venta', 'costo_venta', 'margen', 'gastos', 'cuentas_gastos'));
    }

    public function tributario(){
      $cuentas = Cuenta::all()->sortBy('tipo_cuenta_id');

      $total_debe = 0;
      $total_haber = 0;
      $saldo_deudor = 0;
      $saldo_acreedor = 0;
      $inventario_activo = 0;
      $inventario_pasivo = 0;
      $total_ganancia = 0;
      $total_perdida = 0;
      foreach ($cuentas as $cuenta) {
        $total_debe += $cuenta->sumDebe();
        $total_haber += $cuenta->sumHaber();
        if (TipoCuenta::tratamiento($cuenta->tipo_cuenta_id) == 1) {
          $saldo_deudor += $cuenta->saldo();
        } else {
          $saldo_acreedor += $cuenta->saldo();
        }
        if ($cuenta->tipo_cuenta_id == 1 || $cuenta->tipo_cuenta_id == 2) {
          $inventario_activo += $cuenta->saldo();
        } elseif($cuenta->tipo_cuenta_id == 3 || $cuenta->tipo_cuenta_id == 4 || $cuenta->tipo_cuenta_id == 5) {
          $inventario_pasivo += $cuenta->saldo();
        } elseif($cuenta->tipo_cuenta_id == 6) {
          $total_ganancia += $cuenta->saldo();
        } else {
          $total_perdida += $cuenta->saldo();
        }

      }
      $venta = AsientoContable::venta();
      $costo_venta = AsientoContable::costo_venta();
      $gastos = AsientoContable::gasto() - $costo_venta;
      $utilidad = $venta - $costo_venta - $gastos;

      return view('balance_tributario', compact('cuentas', 'total_debe', 'total_haber', 'saldo_deudor', 'saldo_acreedor', 'inventario_activo', 'inventario_pasivo', 'total_ganancia', 'total_perdida', 'utilidad'));
    }
}
