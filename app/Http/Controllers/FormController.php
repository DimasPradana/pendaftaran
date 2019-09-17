<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FormController extends Controller
{
	///////////////////////////////////////////////////////////////////////////
	/////////////////////////////// Index /////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	// TODO INDEX
	public function index()
	{
		return view('home');
	}


	///////////////////////////////////////////////////////////////////////////
	/////////////////////////////// Lain - Lain ///////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	// TODO lainlain

	public function ajaxRequestPost(){
		$input = request()->all();
		return response()->json($input);
	}

	public function fetch(Request $request){
		if($request->get('query'))
		{
			$query = $request->get('query');
			$data = DB::table('namaskpd')
				->where('namaskpd', 'LIKE', "%{$query}%")
				->get();
			$output = '<ul class="dropdown-menu" style="display:block; position:relative">';
			foreach($data as $row)
			{
				$output .= '
			   <li><a href="#">'.$row->namaskpd.'</a></li>
			   ';
			}
			$output .= '</ul>';
			echo $output;
		}
	}

	public function fetchnpwpd(Request $request){
		if($request->get('querynpwpd'))
		{
			$querynpwpd = $request->get('querynpwpd');
			$datanpwpds = DB::table('npwpd')
				->where('npwpd', 'like',"%{$querynpwpd}%")
				->first();

			//dd($datanpwpds);
			$namawp = $datanpwpds->NamaWP;
			$alamatwp = $datanpwpds->AlamatWP;
			$nohp = $datanpwpds->ContactPerson;
			echo $namawp.";".$alamatwp.";".$nohp;
			//echo $alamatwp;
			//echo $nohp;
		}
	}

	public function fetchruasjalan(Request $request){
		if($request->get('queryruasjalan'))
		{
			$queryruasjalan = $request->get('queryruasjalan');
			$dataruasjalan = DB::table('zona_strategis')
				->where('ruasjalan', 'like', "%{$queryruasjalan}%")
			//->get();
				->first();
			//dd($dataruasjalan->ruasjalan);
			$noid = $dataruasjalan->NoID;
			$_kodezona = $dataruasjalan->kodezona;
			$ruasjalan = $dataruasjalan->ruasjalan;

			$kodezona = "Zona".$_kodezona;

			//echo $noid.";".$_kodezona.";".$ruasjalan;
			echo $noid.";".$_kodezona.";".$ruasjalan;

		}
	}

	public function fetchobyekpajak(Request $request){
		if($request->get('queryobyekpajak'))
		{
			$queryobyekpajak = $request->get('queryobyekpajak');
			$dataobyekpajak = DB::table('tarif_dasar_pajak')
				->where('obyekpajak', 'like', "%{$queryobyekpajak}%")
			//->get();
				->first();
			//dd($dataobyekpajak->SatuanMasa);
			$noid = $dataobyekpajak->NoID;
			$prosentase = $dataobyekpajak->Prosentase;
			$satuanmasa = $dataobyekpajak->SatuanMasa;
			$zona1 = $dataobyekpajak->Zona1;
			$zona2 = $dataobyekpajak->Zona2;
			$zona3 = $dataobyekpajak->Zona3;
			$jenispajak = $dataobyekpajak->JenisPajak;
			$rekeninginduk = $dataobyekpajak->RekeningInduk;
			$_rekeninginduk = substr($dataobyekpajak->RekeningInduk,0,8);
			echo $prosentase.";".$satuanmasa.";".$zona1.";".$zona2.";".$zona3.";".$noid.";".$jenispajak.";".$_rekeninginduk.";".$rekeninginduk;

		}
	}
	///////////////////////////////////////////////////////////////////////////
	/////////////////////////////// Restoran //////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	// TODO pindah restoran
	public function pindah_restoran(){

		$ambildataobyekpajaks = DB::table('koderekening')->where([
			['koderekening','like','4.1.1.02%'] ,
			['pajak','=','0'],
		])->get();

		$ambilskpds = DB::table('namaskpd')
			->groupBy('kodeskpd')
		//->get();
			->toSql();

		return view('restoran/formrestoran', compact([
			'ambildataobyekpajaks',
			'ambilskpds',
			'ambilmaxpendaftaran'
		]));
	}

	// TODO insert restoran
	public function insert_restoran(Request $request){

		$ambilmaxpendaftaran = DB::table('pendaftaran')->max('ID');
		$pendaftaranId =str_pad($ambilmaxpendaftaran+1,7,"0",STR_PAD_LEFT);
		$SKPD = explode("-", $request->input('skpd'));
		$_SKPD = $SKPD[0];

		if($request->input('obyekpajak') == "Catering"){
			$_JenisPajak = "4.1.1.02";
			$_NamaPajak = "Pajak Restoran";
			$_ObyekPajak = "6";
			$_Uraian = "Catering";
			$_ProsentasePajak = "10";
			$_Satuan = "Bulan";
		}elseif($request->input('obyekpajak') == "Rumah Makan"){
			$_JenisPajak = "4.1.1.02";
			$_NamaPajak = "Pajak Restoran";
			$_ObyekPajak = "5";
			$_Uraian = "Rumah Makan";
			$_ProsentasePajak = "10";
			$_Satuan = "Bulan";
		}elseif($request->input('obyekpajak') == "Restoran"){
			$_JenisPajak = "4.1.1.02";
			$_NamaPajak = "Pajak Restoran";
			$_ObyekPajak = "4";
			$_Uraian = "Restoran";
			$_ProsentasePajak = "10";
			$_Satuan = "Bulan";
		}

		DB::table('pendaftaran')->insertGetId([
			'ID'=>$pendaftaranId,
			'NPWPD'=>$request->input('NPWPD'),
			'NamaWP'=>$request->input('NamaWP'),
			'AlamatWP'=>$request->input('AlamatWP'),
			'JenisPajak'=>$request->input('obyekpajak'), 'SKPD'=>$_SKPD,
			'NamaSKPD'=>$request->input('skpd'),
			'Kegiatan'=>$request->input('kegiatan'),
			'NilaiPajak'=> str_replace(".","",$request->input('jumlahpajak')),
			'NoHP'=>$request->input('nohp'),
			'created_at'=>date("Y-m-d"),
			'TanggalTerbit'=>date("Y-m-d"),
			'JenisPajak'=>$_JenisPajak,
			'NamaPajak'=>$_NamaPajak,
			'ObyekPajak'=>$_ObyekPajak,
			'Uraian'=>$_Uraian,
			'ProsentasePajak'=>$_ProsentasePajak,
			'Satuan'=>$_Satuan,
			'KeteranganPajak'=>$request->input('resume')
		]);
		return Redirect::back()->with('alert',$pendaftaranId);
	}



	///////////////////////////////////////////////////////////////////////////
	/////////////////////////////// Hotel /////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	// TODO pindah hotel
	public function pindah_hotel(){

		$ambildataobyekpajaks = DB::table('koderekening')->where([
			['koderekening','like','4.1.1.01%'] ,
			['pajak','=','0'],
		])->get();

		// $ambilskpds = DB::table('namaskpd')
		//     ->groupBy('kodeskpd')
		//     //->get();
		//     ->toSql();

		return view('hotel/formhotel', compact([
			'ambildataobyekpajaks',
			'ambilmaxpendaftaran'
		]));
	}

	// TODO insert hotel
	public function insert_hotel(Request $request){
		$ambilmaxpendaftaran = DB::table('pendaftaran')->max('ID');
		$pendaftaranId =str_pad($ambilmaxpendaftaran+1,7,"0",STR_PAD_LEFT);

		if($request->input('obyekpajak') == "Hotel Melati Satu"){
			$_JenisPajak = "4.1.1.01";
			$_NamaPajak = "Pajak Hotel";
			$_ObyekPajak = "1";
			$_Uraian = "Hotel Melati Satu";
			$_ProsentasePajak = "10";
			$_Satuan = "Bulan";
		}elseif($request->input('obyekpajak') == "Losmen/Rumah Penginapan/Pesanggraha/Hostel/Rumah Kos"){
			$_JenisPajak = "4.1.1.01";
			$_NamaPajak = "Pajak Hotel";
			$_ObyekPajak = "2";
			$_Uraian = "Losmen/Rumah Penginapan/Pesanggraha/Hostel/Rumah Kos";
			$_ProsentasePajak = "10";
			$_Satuan = "Bulan";
		}elseif($request->input('obyekpajak') == "Wisma Pariwisata"){
			$_JenisPajak = "4.1.1.01";
			$_NamaPajak = "Pajak Hotel";
			$_ObyekPajak = "3";
			$_Uraian = "Wisma Pariwisata";
			$_ProsentasePajak = "10";
			$_Satuan = "Bulan";
		}

		DB::table('pendaftaran')->insertGetId([
			'ID'=>$pendaftaranId,
			'NPWPD'=>$request->input('NPWPD'),
			'NamaWP'=>$request->input('NamaWP'),
			'AlamatWP'=>$request->input('AlamatWP'),
			'JenisPajak'=>$request->input('obyekpajak'),
			'Kegiatan'=>$request->input('kegiatan'),
			'NilaiPajak'=> str_replace(".","",$request->input('jumlahpajak')),
			'NoHP'=>$request->input('nohp'),
			'created_at'=>date("Y-m-d"),
			'TanggalTerbit'=>date("Y-m-d"),
			'JenisPajak'=>$_JenisPajak,
			'NamaPajak'=>$_NamaPajak,
			'ObyekPajak'=>$_ObyekPajak,
			'Uraian'=>$_Uraian,
			'ProsentasePajak'=>$_ProsentasePajak,
			'Satuan'=>$_Satuan,
			'KeteranganPajak'=>$request->input('resume')
		]);
		return Redirect::back()->with('alert',$pendaftaranId);
	}


	///////////////////////////////////////////////////////////////////////////
	/////////////////////////////// Hiburan ///////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	// TODO pindah hiburan
	public function pindah_hiburan(){
		return view('hiburan/formhiburan');
	}

	// TODO insert hiburan
	public function insert_hiburan(){
		return 'insert hiburan';
	}


	///////////////////////////////////////////////////////////////////////////
	/////////////////////////////// Reklame ///////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	// TODO pindah reklame
	public function pindah_reklame(){

		$ambildataobyekpajaks_reklame = DB::table('tarif_dasar_pajak')->where([
			['rekeningInduk','like','4.1.1.04.%']
		])->get();

		$ambilruasjalan = DB::table('zona_strategis')->get();

		//dd($ambildataobyekpajaks_reklame);
		return view('reklame/formreklame', compact([
			'ambildataobyekpajaks_reklame',
			'ambilruasjalan',
			'ambilmaxpendaftaran'
		]));
	}

	// TODO insert reklame
	public function insert_reklame(Request $request){
		$ambilmaxpendaftaran = DB::table('pendaftaran')->max('ID');
		$pendaftaranId =str_pad($ambilmaxpendaftaran+1,7,"0",STR_PAD_LEFT);

		// dd($pendaftaranId);

		//if($request->input('obyekpajak') == "Catering"){
		//$_JenisPajak = "4.1.1.02";
		//$_NamaPajak = "Pajak Restoran";
		//$_ObyekPajak = "6";
		//$_Uraian = "Catering";
		//$_ProsentasePajak = "10";
		//$_Satuan = "Bulan";
		//}elseif($request->input('obyekpajak') == "Rumah Makan"){
		//$_JenisPajak = "4.1.1.02";
		//$_NamaPajak = "Pajak Restoran";
		//$_ObyekPajak = "5";
		//$_Uraian = "Rumah Makan";
		//$_ProsentasePajak = "10";
		//$_Satuan = "Bulan";
		//}elseif($request->input('obyekpajak') == "Restoran"){
		//$_JenisPajak = "4.1.1.02";
		//$_NamaPajak = "Pajak Restoran";
		//$_ObyekPajak = "4";
		//$_Uraian = "Restoran";
		//$_ProsentasePajak = "10";
		//$_Satuan = "Bulan";
		//}

		DB::table('pendaftaran')->insertGetId([
			'ID'=>$pendaftaranId,
			'created_at'=>date("Y-m-d"),
			'NPWPD'=>$request->input('npwpd'),
			'NamaWP'=>$request->input('namawp'),
			'TanggalTerbit'=>date("Y-m-d"),
			'AlamatWP'=>$request->input('alamatwp'),
			'JenisPajak'=>$request->input('rekeninginduk'),
			'NamaPajak'=>$request->input('jenispajak'),
			'ObyekPajak'=>$request->input('noid'),
			'Uraian'=>$request->input('obyekpajak'),
			'JumlahSatuan'=>$request->input('jumlahsatuan'),
			'Satuan'=>$request->input('satuan'),
			'Sisi'=>$request->input('sisi'),
			'Panjang'=>$request->input('panjang'),
			'Lebar'=>$request->input('lebar'),
			'KodeRuasJalan'=>$request->input('koderuasjalan'),
			'RuasJalan'=>$request->input('ruasjalan'),
			'KodeZona'=>$request->input('kodezona'),
			'NilaiStrategis'=>$request->input('nilaistrategis'),
			'JumlahReklame'=>$request->input('jumlahreklame'),
			'NilaiPajak'=> str_replace(".","",$request->input('jumlahpajak')),
			'ProsentasePajak'=>$request->input('prosentasepajak'),
			'KeteranganPajak'=>$request->input('resume')
		]);

		return Redirect::back()->with('alert',$pendaftaranId);
	}


	///////////////////////////////////////////////////////////////////////////
	/////////////////////////////// Parkir ////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	// TODO pindah parkir
	public function pindah_parkir(){
		return view('parkir/formparkir');
	}

	// TODO insert parkir
	public function insert_parkir(){
		return 'insert parkir';
	}


	///////////////////////////////////////////////////////////////////////////
	/////////////////////////////// Air Tanah /////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	// TODO pindah air tanah
	public function pindah_airtanah(){
		return view('airtanah/formairtanah');
	}

	// TODO insert air tanah
	public function insert_airtanah(){
		return 'insert air tanah';
	}


	///////////////////////////////////////////////////////////////////////////
	/////////////////////////////// Mineral ///////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	// TODO pindah mineral
	public function pindah_mineral(){
		return view('mineral/formmineral');
	}

	// TODO insert mineral
	public function insert_mineral(){
		return 'insert mineral';
	}

	///////////////////////////////////////////////////////////////////////////
	/////////////////////////////// Antrian ///////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	// TODO pindah antrian
	public function pindah_antrian(){
		$ambilpendaftarans = DB::table('pendaftaran')->paginate(10);
		return view('antrian/formantrian', compact([
			'ambilpendaftarans'
		]));
	}

	// TODO insert antrian
	public function insert_antrian(){
		return 'insert antrian';
	}
}
