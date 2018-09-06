<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TipoCuenta;
use App\DetalleAsientoContable;

class Cuenta extends Model
{
  protected $table = 'cuentas';

  protected $fillable = [
    'nombre', 'tipo_cuenta_id'
  ];

  public function tipo(){
    return $this->belongsTo(TipoCuenta::class, 'tipo_cuenta_id');
  }

  public function asientos(){
    return $this->hasMany(DetalleAsientoContable::class);
  }

  public function sumDebe(){
    $cuenta = $this->asientos;
    return $cuenta->pluck('debe')->sum();
  }

  public function sumHaber(){
    $cuenta = $this->asientos;
    return $cuenta->pluck('haber')->sum();
  }

  public function saldo(){
    $tratamiento = TipoCuenta::tratamiento($this->tipo_cuenta_id);
    if ($tratamiento == 1) {
      return $this->sumDebe() - $this->sumHaber();
    } elseif ($tratamiento == 2) {
      return $this->sumHaber() - $this->sumDebe();
    }
  }

  public function moneda($dinero){
    return "$ ".number_format($dinero, 0, ",", ".");
  }

}
