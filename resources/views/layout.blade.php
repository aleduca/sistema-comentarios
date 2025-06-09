<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
  <title>Sistema de Comentários</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900">
  <div class="container mx-auto">
    @yield('content')
  </div>
</body>
</html>