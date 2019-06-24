<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    //
    public function pindah_restoran(){

        $ambildataobyekpajaks = DB::table('koderekening')->where([
           ['koderekening','like','4.1.1.02%'] ,
            ['pajak','=','0'],
        ])->get();

//        $ambilskpds = DB::table('noskpd')
//        ->get();
//        $ambilskpds = DB::table('namaskpd')
//            ->select('kodeskpd','skpd')
//            ->distinct()
//            ->get();
        $ambilskpds = DB::table('namaskpd')
            ->groupBy('kodeskpd')
            ->get();

        return view('restoran/formrestoran', compact([
            'ambildataobyekpajaks',
            'ambilskpds',
            'ambilnamaskpds'
        ]));
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
    public function pindah_hotel(){
        return view('hotel/formhotel');
    }
    public function pindah_hiburan(){
        return view('hiburan/formhiburan');
    }
    public function pindah_reklame(){
        return view('reklame/formreklame');
    }
    public function pindah_parkir(){
        return view('parkir/formparkir');
    }
    public function pindah_airtanah(){
        return view('airtanah/formairtanah');
    }
    public function pindah_mineral(){
        return view('mineral/formmineral');
    }
}
