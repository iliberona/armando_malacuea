<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ContaICIN</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="/css/master.css">
    <link rel="shortcut icon" href="{{asset('images/fondo.png')}}">
</head>

<body>

  <div class="container" style="margin-bottom: 5%;">
    <br>
            @yield('contenido')



      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content" id="contenido_modal">

          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <nav class="navbar container bg-dark fixed-bottom mx-auto justify-content-center rounded" style="margin: -0.5%;">
        <a href="{{route('cuentas.index')}}"><button class="btn btn-outline-success my-sm-0">Gestion de cuentas</button></a>&nbsp;
        <a href="{{route('asientos_contables.index')}}"><button class="btn btn-outline-success my-sm-0">Asientos contables</button></a>&nbsp;
        <a href="{{route('estado_resultado')}}"><button class="btn btn-outline-success my-sm-0">Estado de resultado</button></a>&nbsp;
        <a href="{{route('balance_general')}}"><button class="btn btn-outline-success my-sm-0">Balance general</button></a>&nbsp;
        <a href="{{route('balance_tributario')}}"><button class="btn btn-outline-success my-sm-0">Balance tributario</button></a>
    </nav>

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript">
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    </script>
    @yield('script')
</body>

</html>
