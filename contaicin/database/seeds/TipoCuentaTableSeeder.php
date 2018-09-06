<?php

use Illuminate\Database\Seeder;

class TipoCuentaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tipo_cuenta')->insert([
          'nombre' => 'Activo Corriente',
          'codigo' => '1.1'
      ]);

      DB::table('tipo_cuenta')->insert([
        'nombre' => 'Activo no Corriente',
        'codigo' => '1.2'
      ]);

      DB::table('tipo_cuenta')->insert([
            'nombre' => 'Pasivo Corriente',
            'codigo' => '2.1'
      ]);


      DB::table('tipo_cuenta')->insert([
            'nombre' => 'Pasivo no Corriente',
            'codigo' => '2.2'
      ]);

      DB::table('tipo_cuenta')->insert([
            'nombre' => 'Patrimonio',
            'codigo' => '3.1'
      ]);

      DB::table('tipo_cuenta')->insert([
            'nombre' => 'Ingreso',
            'codigo' => '4.1'
      ]);

      DB::table('tipo_cuenta')->insert([
            'nombre' => 'Gasto',
            'codigo' => '5.1'
      ]);
    }
}
