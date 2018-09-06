<div class="modal-header bg-success">
  <h5 class="modal-title text-light">Asiento Contable N°{{$asiento->id}}.</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="modal-body">
  <div class="container table-responsive">
    <table class="table table-striped text-center">
      <thead>
        <tr>
          <th class="bg-success text-light" scope="col">N°</th>
          <th class="bg-success text-light" scope="col">Cuenta</th>
          <th class="bg-success text-light" scope="col">Debe</th>
          <th class="bg-success text-light" scope="col">Haber</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($detalle_asiento as $detalle)
          <tr>
            <th  class="bg-secondary text-light" scope="row">{{$detalle->id}}</th>
            <td class="bg-secondary text-light" >{{$detalle->cuenta->nombre}}</td>
            <td class="bg-secondary text-light" >{{($detalle->debe!=0) ? $detalle->debe : '-'}}</td>
            <td class="bg-secondary text-light" >{{($detalle->haber!=0) ? $detalle->haber : '-'}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <p class="text-center"><b>Fecha:</b> {{date("d-m-Y", strtotime($asiento->fecha))}}<br></p>
    <p class="text-center"><b>Glosa:</b> {{$asiento->glosa}}</p>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
</div>
