<?php

use Illuminate\Database\Seeder;

class CuentaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cuentas')->insert([
          'nombre' => 'Efectivo',
          'tipo_cuenta_id' => 1
      ]);

      DB::table('cuentas')->insert([
          'nombre' => 'Banco',
          'tipo_cuenta_id' => 1
      ]);

      DB::table('cuentas')->insert([
          'nombre' => 'Mercaderia',
          'tipo_cuenta_id' => 1
      ]);

      DB::table('cuentas')->insert([
          'nombre' => 'Mobiliaria',
          'tipo_cuenta_id' => 2
      ]);

      DB::table('cuentas')->insert([
          'nombre' => 'Cuentas por cobrar',
          'tipo_cuenta_id' => 3
      ]);

      DB::table('cuentas')->insert([
          'nombre' => 'Cuentas  cobrar',
          'tipo_cuenta_id' => 6
      ]);

      DB::table('cuentas')->insert([
          'nombre' => 'Cuenta',
          'tipo_cuenta_id' => 7
      ]);



    }
}
