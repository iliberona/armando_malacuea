@extends('plantilla')

@section('contenido')
  <div class="card">
    <div class="card-header bg-dark">
      <h2 class="text-light">Asientos contables <i class="fa fa-question-circle float-right" data-toggle="tooltip" data-placement="left" title="Es una anotación en el libro de contabilidad que refleja los movimientos económicos de una persona o institución. Se realiza cada vez que la empresa contabiliza una entrada relacionada con la actividad que realiza."></i></h2>
    </div>

    <div class="card-body bg-secondary">
      <a href="{{route('asientos_contables.create')}}"><button class="btn btn-success btn-block">Nuevo asiento</button></a>

      <br>

      <div id="tabla_cuentas" class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="text-center text-light bg-success" scope="col">N°</th>
              <th class="text-center text-light bg-success" scope="col">Fecha</th>
              <th class="text-center text-light bg-success" scope="col">Glosa</th>
              <th class="text-center text-light bg-success" scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($asientos as $asiento)
              <tr>
                <th class="text-light text-center" scope="row">{{$asiento->id}}</th>
                <td class="text-light text-center" >{{$asiento->fecha}}</td>
                <td class="text-light text-center">{{$asiento->glosa}}</td>
                <td class="text-center" id="{{route('asientos_contables.show',$asiento->id)}}" ><i class='fas fa-eye ver text-light' data-toggle="tooltip" data-placement="bottom" title="Ver"></i>&nbsp &nbsp<i class='fas fa-trash eliminar text-light' data-toggle="tooltip" data-placement="bottom" title="Eliminar"></i></td>
              </tr>
            @empty
          </tbody>
        </table>
        <h4 class="text-center">No registra asientos contables de momento.</h4>
      @endforelse
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
