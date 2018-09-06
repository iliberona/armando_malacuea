@extends('plantilla')

@section('contenido')
  <div class="card">
    <div class="card-header bg-dark">
      <h2 class="text-light">Estado de Resultado <i class="fa fa-question-circle float-right" data-toggle="tooltip" data-placement="left" title="Es un reporte financiero que en base a un periodo determinado muestra de manera detallada los ingresos obtenidos, los gastos en el momento en que se producen y como consecuencia, el beneficio o pérdida que ha generado la empresa en dicho periodo de tiempo para analizar esta información y en base a esto, tomar decisiones de negocio."></i></h2>
    </div>

    <div class="card-body bg-secondary">
      <div class="row justify-content-md-center">
        <table class="table table-bordered table-striped table-sm" style="width: 50%;">
          <tbody>
            <tr>
              <th class="bg-success text-light text-center">Nombre</th>
              <td class="bg-success text-light text-center">Valor</td>
            </tr>
            <tr>
              <th class="text-light text-center">Venta</th>
              <td class="text-light text-center">{{$venta}}</td>
            </tr>
            <tr>
              <th class="text-light text-center">Costo Venta</th>
              <td class="text-light text-center">{{$costo_venta}}</td>
            </tr>
            <tr>
              <th class="text-light text-center">Margen Bruto</th>
              <td class="text-light text-center">{{$margen}}</td>
            </tr>
            <tr>
              <th class="text-light text-center">Gastos de administracion y ventas</th>
              <td class="text-light text-center">{{$gastos}}</td>
            </tr>
            @foreach ($cuentas_gastos as $cuenta)
              @if (strpos($cuenta->nombre,'venta') == false)
                <tr>
                  <td class="text-light text-center">{{$cuenta->nombre}}</td>
                  <td class="text-light text-center">{{$cuenta->saldo()}}</td>
                </tr>
              @endif
            @endforeach
            <tr>
              <th class="text-light text-center">Ingresos no operacionales</th>
              <td class="text-light text-center">-</td>
            </tr>
            <tr>
              <th class="text-light text-center">Gastos no operacionales</th>
              <td class="text-light text-center">-</td>
            </tr>
            <tr>
              <th class="text-light text-center">Resultado antes de impuestos</th>
              <td class="text-light text-center">{{$margen-$gastos}}</td>
            </tr>
            <tr>
              <th class="text-light text-center">Impuesto a la renta</th>
              <td class="text-light text-center">{{($margen-$gastos)*0.24}}</td>
            </tr>
            <tr>
              <th class="text-light text-center">Resultado despues de impuestos</th>
              <td class="text-light text-center">{{($margen-$gastos)*0.76}}</td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '.ver', function() {
        var ruta = $(this).parents('td').attr('id');
        $.get(ruta, function(resp){
          $('#contenido_modal').html(resp);
          $('#modal').modal('toggle');
        });
      });
    });
  </script>
@endsection
