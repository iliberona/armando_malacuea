<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cuenta;

class DetalleAsientoContable extends Model
{
  protected $table = 'detalles_asientos_contables';

  protected $fillable = [
    'asiento_contable_id', 'cuenta_id','debe', 'haber'
  ];

  public function cuenta(){
    return $this->belongsTo(Cuenta::class, 'cuenta_id');
  }
}
