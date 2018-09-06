@extends('plantilla')

@section('contenido')
  <div class="card">
    <div class="card-header bg-dark">
      <h2 class="text-light">Balance Tributario <i class="fa fa-question-circle float-right" data-toggle="tooltip" data-placement="left" title="Es una extensión del balance de comprobación de sumas y saldos, que se confecciona al finalizar el ejercicio contable de la empresa y luego de cerrar todas las cuentas del Libro Mayor que presentaron algún movimiento."></i></h2>
    </div>

    <div class="card-body bg-secondary">
      <div class="container row">
        <table class="table table-bordered table-striped text-center table-sm" >
          <thead>
            <tr>
              <th rowspan="2" class="align-middle bg-success text-light">Detalle</th>
              <th rowspan="2" class="align-middle bg-success text-light">Debitos</th>
              <th rowspan="2" class="align-middle bg-success text-light">Creditos</th>
              <th colspan="2" class="bg-success text-light">Saldos</th>
              <th colspan="2" class="bg-success text-light">Inventario</th>
              <th colspan="2" class="bg-success text-light">Resultado</th>
            </tr>
            <tr>
              <th class="bg-success text-light">Deudor</th>
              <th class="bg-success text-light">Acreedor</th>
              <th class="bg-success text-light">Activo</th>
              <th class="bg-success text-light">Pasivo</th>
              <th class="bg-success text-light">Ganancia</th>
              <th class="bg-success text-light">Perdida</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($cuentas as $cuenta)

              <tr>
                <td>{{$cuenta->nombre}}</td>
                <td>{{($cuenta->sumDebe() != 0) ? $cuenta->sumDebe() : '-'}}</td>
                <td>{{($cuenta->sumHaber() != 0) ? $cuenta->sumHaber() : '-'}}</td>
                <td>{{(App\TipoCuenta::tratamiento($cuenta->tipo_cuenta_id) == 1) ? (($cuenta->saldo() != 0) ? $cuenta->saldo() : '-') : '-'}}</td>
                <td>{{(App\TipoCuenta:: tratamiento($cuenta->tipo_cuenta_id) == 2) ? (($cuenta->saldo() != 0) ? $cuenta->saldo() : '-') : '-'}}</td>
                @if ($cuenta->tipo_cuenta_id != 6 && $cuenta->tipo_cuenta_id != 7)
                  <td>{{(App\TipoCuenta::tratamiento($cuenta->tipo_cuenta_id) == 1) ? (($cuenta->saldo() != 0) ? $cuenta->saldo() : '-') : '-'}}</td>
                  <td>{{(App\TipoCuenta::tratamiento($cuenta->tipo_cuenta_id) == 2) ? (($cuenta->saldo() != 0) ? $cuenta->saldo() : '-') : '-'}}</td>
                @else
                  <td>-</td>
                  <td>-</td>
                @endif
                @if ($cuenta->tipo_cuenta_id == 6 || $cuenta->tipo_cuenta_id == 7)
                  <td>{{(App\TipoCuenta::tratamiento($cuenta->tipo_cuenta_id) == 1) ? (($cuenta->saldo() != 0) ? '-' : $cuenta->saldo()) : $cuenta->saldo()}}</td>
                  <td>{{(App\TipoCuenta::tratamiento($cuenta->tipo_cuenta_id) == 2) ? (($cuenta->saldo() != 0) ? '-' : $cuenta->saldo()) : $cuenta->saldo()}}</td>
                @else
                  <td>-</td>
                  <td>-</td>
                @endif
              </tr>
            @endforeach
            <tr>
              <th class="bg-success text-light">Totales</th>
              <th>{{$total_debe}}</th>
              <th>{{$total_haber}}</th>
              <th>{{$saldo_deudor}}</th>
              <th>{{$saldo_acreedor}}</th>
              <th>{{$inventario_activo}}</th>
              <th>{{$inventario_pasivo}}</th>
              <th>{{$total_ganancia}}</th>
              <th>{{$total_perdida}}</th>
            </tr>
            <tr>
              <th class="bg-success text-light">Resultado del ejercicio</th>
              @for ($i=0; $i < 5; $i++)
                <th>-</th>
              @endfor
              <th>{{$utilidad}}</th>
              <th>-</th>
              <th>{{$utilidad}}</th>
            </tr>
            <tr>
              <th class="bg-success text-light">Totales iguales</th>
              <th>{{$total_debe}}</th>
              <th>{{$total_haber}}</th>
              <th>{{$saldo_deudor}}</th>
              <th>{{$saldo_acreedor}}</th>
              <th>{{$inventario_activo}}</th>
              <th>{{$inventario_pasivo+$utilidad}}</th>
              <th>{{$total_ganancia}}</th>
              <th>{{$total_perdida+$utilidad}}</th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div> bg-success text-light
@endsection
