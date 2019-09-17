@extends('layouts.index')
@section('content')
<div class="section">
    <div class="card-panel purple darken-3 white-text">
        {{--NPWPD / NIK : {{$ambildatanpwpds->NPWPD}}--}}
        {{--<ul>--}}
            {{--<li>Nama : {{$ambildatanpwpds->NamaWP}}</li>--}}
            {{--<li>Alamat : {{$ambildatanpwpds->AlamatWP}}</li>--}}
            {{--<li>Nomer Handphone : {{$ambildatanpwpds->ContactPerson}}</li>--}}
        {{--</ul>--}}
		<ul>Cara Pengisian Form
			<li>1. Pilih jenis pajak yang akan diajukan</li>
			<li>2. Isikan informasi dengan benar pada form pengajuan</li>
			<li>3. Catat nomor tiket yang muncul pada akhir pengajuan pajak</li>
			<li>4. Infokan pada petugas pajak, nomor tiket yang anda catat</li>
			<li>5. Satu tiket untuk satu kegiatan / pengajuan pajak</li>
		</ul>
    </div>
</div>
<div class="section">
    {{-- <ul>Cara Pengisian Form --}}
    {{--     <li>1. Pilih jenis pajak yang akan diajukan</li> --}}
    {{--     <li>2. Isikan informasi dengan benar pada form pengajuan</li> --}}
    {{--     <li>3. Catat nomor tiket yang muncul pada akhir pengajuan pajak</li> --}}
    {{--     <li>4. Infokan pada petugas pajak nomor tiket yang anda catat</li> --}}
    {{--     <li>5. Satu tiket untuk satu kegiatan / pengajuan pajak</li> --}}
    {{-- </ul> --}}
</div>
@endsection
