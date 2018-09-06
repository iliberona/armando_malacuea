<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cuenta;

class TipoCuenta extends Model
{
    protected $table = 'tipo_cuenta';

    public function cuentas(){
      return $this->hasMany(Cuenta::class);
    }

    public function total(){
      $cuentas = $this->cuentas;
      $total = 0;
      foreach ($cuentas as $cuenta) {
        $total += $cuenta->saldo();
      }
      return $total;
    }

    public static function tratamiento($id){
      if($id == 1 || $id == 2 || $id == 7){
        return 1;
      } else {
        return 2;
      }
    }

}
