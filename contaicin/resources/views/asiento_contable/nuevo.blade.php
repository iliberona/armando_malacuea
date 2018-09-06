@extends('plantilla')

@section('contenido')
  <div class="card">
    <div class="card-header bg-dark">
      <h2 class="text-light">Nuevo Asiento Contable <i class="fa fa-question-circle float-right" data-toggle="tooltip" data-placement="left" title="Es una anotación en el libro de contabilidad que refleja los movimientos económicos de una persona o institución. Se realiza cada vez que la empresa contabiliza una entrada relacionada con la actividad que realiza."></i></h2>
    </div>

    <div class="card-body bg-secondary">
      <form id="form_nuevo_asiento" action="{{route('asientos_contables.store')}}">
        {{ csrf_field() }}

        <div class="form-inline">
           <label class="text-light">Fecha: </label><input type="date" class="form-control mb-2 mr-sm-2" name="fecha">
        </div>
        <br>
        <div class="row table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="text-center" scope="col">N°</th>
                <th class="text-center" scope="col">Cuenta</th>
                <th class="text-center" scope="col">Debe</th>
                <th class="text-center" scope="col">Haber</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
          <div class="text-center">
            <button id="agregar" type="button" class="btn btn-success"><i class='fa fa-plus'></i> Añadir movimiento</button>&nbsp;&nbsp;
            <button id="remover" type="button" class="btn btn-success"><i class='fa fa-minus'></i> Quitar movimiento</button>
          </div>
          <br>
          <div class="form-inline">
            <input type="text" class="form-control mx-auto d-block" name="glosa" placeholder="Glosa">
          </div>
          <br>
          <input type="submit" class="btn btn-success mx-auto d-block" value="Guardar">
        </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function() {

      $(document).on('submit','#form_nuevo_asiento',function(event) {
          event.preventDefault();

          var url = $(this).attr('action');
          var token = $('input[name=_token]').val();
          var datos = $(this).serialize();

          ajax_asientos(url, token, datos);
      });

      $(document).on('click', '#agregar', function(){
        var num_filas = $('tbody tr').length+1;
        var select = '{!!$select!!}';
        var campo = '';
        campo += '<tr id="'+num_filas+'">';
        campo += '<th scope="row">'+num_filas+'</th>';
        campo += '<td>'+select+'</td>';
        campo += '<td><input type="number" class="form-control" name="debe[]" min="0" required></td>';
        campo += '<td><input type="number" class="form-control" name="haber[]" min="0" required></td>';
        campo += '</tr>';
        console.log(select);
        $('tbody').append(campo);
      });

      $(document).on('click', '#remover', function(){
        var num_filas = $('tbody tr').length;
        if (num_filas>0) {
          $('tr').last().remove();
        }
      });


    });

    function ajax_asientos(url, token, datos){
      $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN' : token},
        type: 'POST',
        dataType: 'json',
        data: datos
      })
      .done(function(resp) {
        console.log(resp);
        alert('Se ha añadido el asiento contable');
        window.location.replace('{{route('asientos_contables.index')}}');
      })
      .fail(function(data) {
        alert('Ha ocurrido un error inesperado.');
        console.log("error");
        console.log(data.responseText);
      })
      .always(function() {
        console.log("complete");
      });
    }
  </script>
@endsection
