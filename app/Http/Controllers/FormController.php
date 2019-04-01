<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FormController extends Controller
{
    // Restoran
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
                'JenisPajak'=>$request->input('obyekpajak'),
                'SKPD'=>$_SKPD,
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

//                dd($datanpwpds);
                $namawp = $datanpwpds->NamaWP;
                $alamatwp = $datanpwpds->AlamatWP;
                $nohp = $datanpwpds->ContactPerson;
                echo $namawp.";".$alamatwp.";".$nohp;
//                echo $alamatwp;
//                echo $nohp;
            }
        }


    // Hotel
        public function pindah_hotel(){
            return view('hotel/formhotel');
        }


    // Hiburan
        public function pindah_hiburan(){
            return view('hiburan/formhiburan');
        }


    //Reklame
        public function pindah_reklame(){
            return view('reklame/formreklame');
        }


    // Parkir
        public function pindah_parkir(){
            return view('parkir/formparkir');
        }


    // Air tanah
        public function pindah_airtanah(){
            return view('airtanah/formairtanah');
        }


    // Mineral
        public function pindah_mineral(){
            return view('mineral/formmineral');
        }

}
