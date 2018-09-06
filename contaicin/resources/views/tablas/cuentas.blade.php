<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">N°</th>
      <th scope="col">Nombre</th>
      <th scope="col">Tipo</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($cuentas as $cuenta)
      <tr>
        <th scope="row">{{$cuenta->id}}</th>
        <td>{{$cuenta->nombre}}</td>
        <td>{{$cuenta->tipo->nombre}}</td>
        <td><i class='fas fa-edit modificar'></i>&nbsp &nbsp<i class='fas fa-trash eliminar'></i></td>
      </tr>
    @empty
  </tbody>
</table>
<h4 class="text-center">No registra cuentas en el plan de su empresa.</h4>
@endforelse
