@extends('plantilla')

@section('contenido')
  <div class="card">
    <div class="card-header bg-dark">
      <h2 class="text-light">Plan de cuentas <i class="fa fa-question-circle float-right" data-toggle="tooltip" data-placement="left" title="El listado de las cuentas de una empresa que se manejan dentro de la Contabilidad, y en el que presentan la situación de los activos y pasivos de la organización. Estas cuentas son las que la empresa ha definido para registrar sus procesos contables."></i></h2>
    </div>

    <div class="card-body bg-secondary">

      <button class="btn btn-success btn-block" data-toggle="collapse" data-target="#añadir_cuenta">Añadir cuenta</button>

      <div id="añadir_cuenta" class="collapse">
        <br>
        <form id="form_nueva_cuenta" action="{{route('cuentas.store')}}">
          {{ csrf_field() }}
          <div class="">
            <div class="col-6 mx-auto d-block">
              <label class="sr-only" for="inlineFormInputName">Name</label>
              <input type="text" class="form-control" id="inlineFormInputName" name="nombre_cuenta" placeholder="Nombre">
            </div>
            <div class="col-6 mx-auto d-block">
              <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
              <select class="custom-select my-1 mr-sm-2" name="tipo_cuenta" id="inlineFormCustomSelectPref">
                <option selected>Tipo de cuenta</option>
                @foreach ($tipo_cuenta as $tipo)
                  <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                @endforeach
              </select>
            </div>

            <br>

            <input type="submit" class="btn btn-success mx-auto d-block" value="Añadir">
          </div>
        </form>
      </div>

      <br>

      <div>
        <!-- Control buttons -->
        <div id="myBtnContainer">
          <button class="btn-caja active" onclick="filterSelection('all')">Mostrar todos</button>

          @foreach ($tipo_cuenta as $tipo)
            <button class="btn-caja" onclick="filterSelection('{{$tipo->nombre}}')">{{$tipo->nombre}}</button>
          @endforeach
        </div>

        <br>

        <!-- The filterable elements. Note that some have multiple class names (this can be used if they belong to multiple categories) -->
          @forelse ($cuentas as $cuenta)
            <div class="filterDiv {{$cuenta->tipo->nombre}}" style="font-size: 0.8vw;">{{$cuenta->nombre}}<br /><a href="#" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-trash"></i></a></div>
            @empty
            <h4 class="text-center">No registra cuentas en el plan de su empresa.</h4>
          @endforelse
      </div>
   </div>

   <br>

   <!-- Cuentas T -->
   <div class="card">
     <div class="card-header bg-dark">
       <h2 class="text-light">Cuentas T <i class="fa fa-question-circle float-right" data-toggle="tooltip" data-placement="left" title="Permite visualizar los débitos y créditos de cada cuenta, además de representar gráficamente tanto la capacidad de dar y recibir como sus movimientos."></i></h2>
     </div>

     <div class="card-body bg-secondary">
       <div class="row">
         @foreach ($cuentas as $cuenta)
               <div class="col-4" style="margin-bottom: 10px;margin-top: 10px;">
                 <div id="tabla_cuentas" class="container table-responsive">
                   <table class="table table-bordered table-hover text-center table-sm">
                     <thead class="table-secondary">
                       <tr>
                         <th colspan="2" style="background-color: #28a745;">{{$cuenta->nombre}}</th>
                       </tr>
                       <tr>
                         <th>Debe</th>
                         <th>Haber</th>
                       </tr>
                     </thead>

                     <tbody>
                       @foreach ($cuenta->asientos as $detalle)
                         <tr>
                           <td>{{($detalle->debe!=0) ? $cuenta->moneda($detalle->debe) : '-'}}</td>
                           <td>{{($detalle->haber!=0) ? $cuenta->moneda($detalle->haber) : '-'}}</td>
                         </tr>
                       @endforeach
                     </tbody>
                     <tr>
                       <th>{{$cuenta->moneda($cuenta->sumDebe())}}</th>
                       <th>{{$cuenta->moneda($cuenta->sumHaber())}}</th>
                     </tr>
                     <tr class="table-warning">
                       @if ($cuenta->tipo_cuenta_id == 2)
                         <th style="background-color: #28a745;">Saldo Acreedor</th>
                       @endif
                       <th style="background-color: #28a745;">{{$cuenta->moneda($cuenta->saldo())}}</th>
                       @if ($cuenta->tipo_cuenta_id == 1)
                         <th style="background-color: #28a745;">Saldo Deudor</th>
                       @endif
                     </tr>
                   </table>
                 </div>
               </div>
               <br>
         @endforeach
       </div>
     </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript">
    /* Obtencion de los datos de nuevo plan de cuenta */
    $(document).on('submit', '#form_nueva_cuenta', function(event){
      event.preventDefault();

      var url = $(this).attr('action');
      var token = $('input[name=_token]').val();
      var datos = $(this).serialize();

      ajax_cuenta(url,token,datos);
    });

    function ajax_cuenta(url, token, datos){
      $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN' : token},
        type: 'POST',
        dataType: 'json',
        data: datos
      })
      .done(function(resp) {
        console.log("success");
        alert('Se ha añadido la cuenta con exito!');
        location.reload();
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

    filterSelection("all")
      function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("filterDiv");
        if (c == "all") c = "";
        // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
        for (i = 0; i < x.length; i++) {
          w3RemoveClass(x[i], "show");
          if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
        }
      }

      // Show filtered elements
      function w3AddClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
          if (arr1.indexOf(arr2[i]) == -1) {
            element.className += " " + arr2[i];
          }
        }
      }

      // Hide elements that are not selected
      function w3RemoveClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
          while (arr1.indexOf(arr2[i]) > -1) {
            arr1.splice(arr1.indexOf(arr2[i]), 1);
          }
        }
        element.className = arr1.join(" ");
      }

      // Add active class to the current control button (highlight it)
      var btnContainer = document.getElementById("myBtnContainer");
      var btns = btnContainer.getElementsByClassName("btn-caja");
      for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
          var current = document.getElementsByClassName("active");
          current[0].className = current[0].className.replace(" active", "");
          this.className += " active";
        });
      }
  </script>
@endsection
