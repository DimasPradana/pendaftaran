<!DOCTYPE html>
<head>
	<title>BPPKAD SITUBONDO</title>
	<link rel="stylesheet" href="{{asset('public/css/materialize.min.css')}}">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	@section('css')

    @show
</head>
<body>
@section('header')
    @include('layouts.header')
@show

<div class="container">
	@yield('content')
</div>

<script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('public/js/materialize.min.js')}}"></script>
</body>
</html>
