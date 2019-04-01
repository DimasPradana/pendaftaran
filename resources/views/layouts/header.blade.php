<nav class="orange accent-3" role="navigation">
    <div class="nav-wrapper">
      <a id="logo-container" href="#" class="brand-logo right">BPPKAD</a>
        <a href="#" data-target="mobile-view" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="hide-on-med-and-down">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('formRestoran') }}">Restoran</a></li>
        <li><a href="{{ route('formHotel') }}">Hotel</a></li>
        <li><a href="{{ route('formHiburan') }}">Hiburan</a></li>
        <li><a href="{{ route('formReklame') }}">Reklame</a></li>
        <li><a href="{{ route('formParkir') }}">Parkir</a></li>
        <li><a href="{{ route('formAirtanah')  }}">Air Tanah</a></li>
        <li><a href="{{ route('formMineral') }}">Mineral</a></li>
      </ul>
    </div>
</nav>
<ul class="sidenav" id="mobile-view">
  <li><a href="{{ url('/') }}">Home</a></li>
  <li><a href="{{ route('formRestoran') }}">Restoran</a></li>
  <li><a href="{{ route('formHotel') }}">Hotel</a></li>
  <li><a href="{{ route('formHiburan') }}">Hiburan</a></li>
  <li><a href="{{ route('formReklame') }}">Reklame</a></li>
  <li><a href="{{ route('formParkir') }}">Parkir</a></li>
  <li><a href="{{ route('formAirtanah') }}">Air Tanah</a></li>
  <li><a href="{{ route('formMineral') }}">Mineral</a></li>
</ul>
<script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
<script>
   $(document).ready(function(){
    $('.sidenav').sidenav();
  });
</script>
