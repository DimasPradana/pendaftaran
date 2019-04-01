@extends('layouts.index')
@section('content')

<div class="section">
	<div class="card-panel purple darken-3 white-text">FORM PENGAJUAN PAJAK DAERAH</div>
</div>

<div class="section">
	{{--<div class="row">--}}
		{{--<div class="col s12">--}}
			{{--<h5>Judul nya disini</h5>--}}

            {{--<div class="divider"></div>--}}
            {{--<p>Sriracha biodiesel taxidermy organic post-ironic, Intelligentsia salvia mustache 90's code editing brunch. Butcher polaroid VHS art party, hashtag Brooklyn deep v PBR narwhal sustainable mixtape swag wolf squid tote bag. Tote bag cronut semiotics,</p>--}}

            {{--<button class="btn btn-flat pink accent-3 waves-effect waves-light white-text">Readmore <i class="material-icons right">send</i></button>--}}
            {{--<button class="btn btn-flat purple darken-4 waves-effect waves-light white-text">Edit <i class="material-icons right">mode_edit</i></button>--}}
            {{--<button class="btn btn-flat red darken-4 waves-effect waves-light white-text">Delete <i class="material-icons right">delete</i></button>--}}
		{{--</div>--}}
	{{--</div>--}}

	{{--<div class="row">--}}
		{{--<div class="col s12">--}}
			{{--<h5>Judul nya disini</h5>--}}

            {{--<div class="divider"></div>--}}
            {{--<p>Sriracha biodiesel taxidermy organic post-ironic, Intelligentsia salvia mustache 90's code editing brunch. Butcher polaroid VHS art party, hashtag Brooklyn deep v PBR narwhal sustainable mixtape swag wolf squid tote bag. Tote bag cronut semiotics,</p>--}}

            {{--<button class="btn btn-flat pink accent-3 waves-effect waves-light white-text">Readmore <i class="material-icons right">send</i></button>--}}
            {{--<button class="btn btn-flat purple darken-4 waves-effect waves-light white-text">Edit <i class="material-icons right">mode_edit</i></button>--}}
            {{--<button class="btn btn-flat red darken-4 waves-effect waves-light white-text">Delete <i class="material-icons right">delete</i></button>--}}
		{{--</div>--}}
	{{--</div>--}}
	{{--<div class="row">--}}
		{{--<div class="col s12">--}}
			{{--<h5>Judul nya disini</h5>--}}

            {{--<div class="divider"></div>--}}
            {{--<p>Sriracha biodiesel taxidermy organic post-ironic, Intelligentsia salvia mustache 90's code editing brunch. Butcher polaroid VHS art party, hashtag Brooklyn deep v PBR narwhal sustainable mixtape swag wolf squid tote bag. Tote bag cronut semiotics,</p>--}}

            {{--<button class="btn btn-flat pink accent-3 waves-effect waves-light white-text">Readmore <i class="material-icons right">send</i></button>--}}
            {{--<button class="btn btn-flat purple darken-4 waves-effect waves-light white-text">Edit <i class="material-icons right">mode_edit</i></button>--}}
            {{--<button class="btn btn-flat red darken-4 waves-effect waves-light white-text">Delete <i class="material-icons right">delete</i></button>--}}
		{{--</div>--}}
	{{--</div>--}}
    @foreach($datas as $data)
    <div class="row">
        <div class="col s12">
            <p>{{$data->NPWPD}}</p>
            <p>{{$data->NamaWP}}</p>
            <div class="divider"></div>
            {{--<a class="btn btn-flat pink accent-3 waves-effect waves-light white-text">Readmore <i class="material-icons right">send</i></a>--}}
            {{--<a class="btn btn-flat purple darken-4 waves-effect waves-light white-text">Edit <i class="material-icons right">mode_edit</i></a>--}}
            {{--<a class="btn btn-flat red darken-4 waves-effect waves-light white-text">Delete <i class="material-icons right">delete</i></a>--}}
        </div>
    </div>
    @endforeach
</div>


<div class="fixed-action-btn horizontal" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red">
      <i class="large material-icons">add</i>
    </a>
  </div>


@endsection