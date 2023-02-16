<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="{{ asset('css/adminlibs.css') }}" >
	<script>
          window.Laravel = <?php echo json_encode([
              'csrfToken' => csrf_token(),
          ]); ?>
        </script>

</head>
<body>
	<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Visor de PDFS</a>
</nav>
<div class="row" id="app">

    @yield('content')
</div>


</body>
<script src="{{ asset('js/app.js') }}" ></script>
</html>