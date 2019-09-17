@extends('layouts.index')
@section('content')
	<div class="section">
		<h4>Pajak Reklame</h4>
	</div>

	<div id="section">
		<form action="{{URL('FormController/insertReklame')}}" method="POST">
			{{ csrf_field() }}
			<div class="row">
				<div class="input-field col s12">
					{{--isi dari div--}}
					<input  id="npwpd" type="text" class="validate" name="npwpd">
					<label for="disabled">NPWPD</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					{{--isi dari div--}}
					<input readonly id="namawp" type="text" class="validate" name="namawp" placeholder="Nama Wajib Pajak">
					<label for="disabled">Nama</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					{{--isi dari div--}}
					<input readonly id="alamatwp" type="text" class="validate" name="alamatwp" placeholder="Alamat Wajib Pajak">
					<label for="disabled">Alamat</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					{{--isi dari div--}}
					<select class="select autofill" name="obyekpajak" id="obyekpajak">
						<option value="" disabled selected>Pilih Obyek Pajak</option>
						@foreach($ambildataobyekpajaks_reklame as $ambildataobyekpajak_reklame)
							{{--<option value="{{$ambildataobyekpajak_reklame->NoID}}">{{$ambildataobyekpajak_reklame->ObyekPajak}}</option>--}}
							<option value="{{$ambildataobyekpajak_reklame->ObyekPajak}}">{{$ambildataobyekpajak_reklame->ObyekPajak}}</option>
						@endforeach
					</select>
					<label for="obyekpajak" id="lblOP">Obyek Pajak</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s4">
					{{--isi dari div--}}
					<input readonly id="nilaipajak" type="text" class="validate autofill" name="nilaipajak" placeholder="Nilai Pajak">
					{{-- <label for="NilaiPajak">Nilai Pajak</label> --}}
				</div>
				<div class="input-field col s4">
					{{--isi dari div--}}
					<input readonly id="prosentasepajak" type="text" class="validate" name="prosentasepajak" placeholder="Prosentase Pajak">
					<label for="ProsentasePajak">Prosentase Pajak</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s4">
					{{--isi dari div--}}
					<input id="jumlahsatuan" type="number" class="validate autofill" name="jumlahsatuan">
					<label for="JumlahSatuan">Jumlah Satuan</label>
				</div>
				<div class="input-field col s4">
					{{--isi dari div--}}
					<input readonly id="satuan" type="text" class="validate autofill" name="satuan" placeholder="Satuan">
					<label for="Satuan">Satuan</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s4">
					{{--isi dari div--}}
					<input id="sisi" type="number" class="validate autofill" name="sisi">
					<label for="Sisi">Sisi</label>
				</div>
				<div class="input-field col s4">
					{{--isi dari div--}}
					<input id="panjang" type="number" class="validate autofill" name="panjang">
					<label for="Panjang">Panjang</label>
				</div>
				<div class="input-field col s4">
					{{--isi dari div--}}
					<input id="lebar" type="number" class="validate autofill" name="lebar">
					<label for="Lebar">Lebar</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					{{--isi dari div--}}
					<select class="select autofill" name="ruasjalan" id="ruasjalan">
						<option value="" disabled selected>Pilih Ruas Jalan</option>
						@foreach($ambilruasjalan as $ambilruasjalan)
							{{--<option value="{{$ambilruasjalan->NoID}}">{{$ambilruasjalan->ruasjalan}}</option>--}}
							<option value="{{$ambilruasjalan->ruasjalan}}">{{$ambilruasjalan->ruasjalan}}</option>
						@endforeach
					</select>
					<label for="ruasjalan" id="lblRuasJalan">Ruas Jalan</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s4">
					{{--isi dari div--}}
					<input id="jumlahreklame" type="number" class="validate autofill" name="jumlahreklame">
					<label for="JumlahReklame">Jumlah Reklame</label>
				</div>
				<div class="input-field col s4">
					{{--isi dari div--}}
					<input readonly id="kodezona" type="text" class="validate" name="kodezona" placeholder="Kode Zona">
					<label for="KodeZona">Kode Zona</label>
				</div>
				<div class="input-field col s4">
					{{--isi dari div--}}
					<input readonly id="nilaistrategis" type="text" class="validate autofill" name="nilaistrategis" placeholder="Nilai Strategis">
					<label for="NilaiStrategis">Nilai Strategis</label>
				</div>
			</div>
			<div class="row" hidden>
				<div class="input-field col s2">
					{{--isi dari div--}}
					{{-- <label for="disabled">NoID</label> --}}
					<input readonly id="noid" type="text" class="validate" name="noid" placeholder="No Ruas Jalan">
				</div>
				<div class="input-field col s2">
					{{--isi dari div--}}
					{{-- <label for="disabled">rekeninginduk</label> --}}
					<input readonly id="rekeninginduk" type="text" class="validate" name="rekeninginduk" placeholder="Rekening Induk">
				</div>
				<div class="input-field col s2">
					{{--isi dari div--}}
					{{-- <label for="disabled">JenisPajak</label> --}}
					<input readonly id="jenispajak" type="text" class="validate" name="jenispajak" placeholder="Jenis Pajak">
				</div>
				<div class="input-field col s2">
					{{--isi dari div--}}
					{{-- <label for="disabled">JenisPajak</label> --}}
					<input readonly id="koderuasjalan" type="text" class="validate" name="koderuasjalan" placeholder="Kode Ruas Jalan">
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<textarea readonly id="resume" name="resume" class="materialize-textarea"></textarea>
					<button class="btn waves-effect waves-light modal-trigger teal white-text" href="#modal1">Confirm
						<i class="material-icons right">check</i>
					</button>
				</div>
			</div>

			{{--modal--}}
			<div class="modal" id="modal1">
				<div class="modal-content">
					Informasikan nomor tersebut pada petugas pajak di kantor BPPKAD melalui WhatsApp :
					<ul>
						<li>- Rizal  : xxxxxxxxxxxxx</li>
						<li>- Titien : xxxxxxxxxxxxx</li>
						<li>- Susi   : xxxxxxxxxxxxx</li>
					</ul>
				</div>
				<div class="modal-footer">
					<a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
					<button class="btn-small waves-effect waves-light teal white-text" type="submit" name="submit">Submit
						<i class="material-icons right">done_all</i>
					</button>
				</div>
			</div>
		</form>
	</div>
	<script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
	<script src="{{asset('public/js/jquery.mask.min.js')}}"></script>
	<script>
		// untuk jquery
		$(document).ready(function(){

			//$(.tooltip).tooltip();
			$('#obyekpajak').formSelect();
			$('#ruasjalan').formSelect();
			$('.tooltip').tooltip();
			$('#modal1').modal();
			$('#nilaipajak').hide();

			// ambil data npwpd
			$('#npwpd').keyup(function(){
				var querynpwpd = $(this).val();
				if(querynpwpd != ''){
					var _token = $('input[name="_token"]').val();
					$.ajax({
						url: "{{route('autocomplete.fetchnpwpd')}}",
						method:"POST",
						data:{querynpwpd:querynpwpd, _token:_token},
						success:function (data){
							var _data = data.split(";",3);
							$('#namawp').val(_data[0]);
							$('#alamatwp').val(_data[1]);
							$('#nohp').val(_data[2]);
						}
					});
				}
			});

			$('#obyekpajak').change(function(){
				var queryobyekpajak = $(this).val();
				if(queryobyekpajak != ''){
					var _token = $('input[name="_token"]').val();
					$.ajax({
						url: "{{route('autocomplete.fetchobyekpajak')}}",
						method:"POST",
						data:{queryobyekpajak:queryobyekpajak, _token:_token},
						success:function (data){
							// var _data = data.split(";",5);
							// _dataOP = data.split(";",5);
							_dataOP = data.split(";",9);
							$('#prosentasepajak').val(_dataOP[0]);
							$('#satuan').val(_dataOP[1]);
							$('#noid').val(_dataOP[5]);
							$('#jenispajak').val(_dataOP[6]);
							$('#rekeninginduk').val(_dataOP[7]);
							console.log(_dataOP);
						}
					});
				}
			});

			$('#ruasjalan').change(function(){
				var queryruasjalan = $(this).val();
				if(queryruasjalan != ''){
					var _token = $('input[name="_token"]').val();
					$.ajax({
						url: "{{route('autocomplete.fetchruasjalan')}}",
						method:"POST",
						data:{queryruasjalan:queryruasjalan, _token:_token},
						success:function (data){
							var _data = data.split(";",3);
							var kd_temp = parseInt(_data[1])+1;
							$('#kodezona').val(_data[1]);
							$('#koderuasjalan').val(_data[0]);
							$('#nilaistrategis').val(_dataOP[kd_temp]);
							// var kdzona= 'Zona'+_data[1];
							// console.log(kd_temp+' ini  kd_temp');
							// console.log(_data[1]+' ini _data[1]');
							// console.log(_dataOP[kd_temp]+' ini nilai strategis');
						}
					});
				}
				$('#nilaipajak').show();
			});

		});

// autofill textarea
// TODO dimas Rab 12 Jun 2019 11:30:57  WIB
$('.autofill').focusout(function(){
	var obyekpajak = "";
	var nilaipajak = "";
	var jumlahsatuan = "";
	var satuan = "";
	var sisi = "";
	var panjang = "";
	var lebar = "";
	var ruasjalan = "";
	var nilaistrategis = "";
	var njop = "";
	var jumlahreklame = "";
	$('#resume').val('');

	obyekpajak = $('#obyekpajak').val();
	nilaipajak = $('#nilaipajak').val();
	jumlahsatuan = $('#jumlahsatuan').val();
	prosentase = $('#prosentasepajak').val();
	satuan = $('#satuan').val();
	sisi = $('#sisi').val();
	panjang = $('#panjang').val();
	lebar = $('#lebar').val();
	ruasjalan = $('#ruasjalan').val();
	nilaistrategis = $('#nilaistrategis').val();
	njop = $('#njop').val();
	jumlahreklame = $('#jumlahreklame').val();
	var tarifreklame = nilaistrategis * prosentase / 100;
	console.log('tarif reklame adalah = ' + nilaistrategis + 'x ' + prosentase + ' / 100 ' + ' = ' + tarifreklame);
	var nilaipajak = sisi * tarifreklame * panjang * lebar * jumlahsatuan * jumlahreklame;
	//var resume = obyekpajak + ' \"' + kegiatan + ' \(' + skpd + '\)\" sebesar Rp.' + jumlahpajak + ',- x 10%';
	var resume = obyekpajak + ' di ' + ruasjalan + ' = ' + sisi + ' sisi x Rp ' + tarifreklame + ' x panjang  ' + panjang + ' m x lebar ' + lebar + ' m x ' + jumlahsatuan + ' ' + satuan + ' x ' + jumlahreklame + ' unit';

	$('#nilaipajak').val(nilaipajak);
	$('#resume').val(resume);
	$('#resume').trigger('autoresize');
});

var msg = '{{Session::get('alert')}}';
var exist = '{{Session::has('alert')}}';
if(exist){
	alert('Nomor tiket pendaftaranmu adalah : '+ msg);
}
// mask number menggunakan plugin jquery.mask.js
$('#nilaipajak').mask("#.##0", {reverse:true});
$('#nilaistrategis').mask("#.##0", {reverse:true});
	</script>
@endsection

