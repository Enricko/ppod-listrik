<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tagihan;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class Frontend extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->User = new User;
        $this->Tagihan = new Tagihan;
    }
    public function index(Request $request){
        $data['penggunaan'] = $this->User->get_penggunaan();
        $data['tarif'] = $this->User->get_tarif();
        $data['tagihan'] = $this->Tagihan->get_tagihan_process_row();
        $data['tagihan_process'] = $this->Tagihan->get_tagihan_process();
        return view('frontend.index',$data);
    }
    public function error(){
        return view('layouts.error');
    }
    public static function digits($digit){
        $digits = array(
            1000 * 1000 * 1000 * 1000 * 1000 * 1000 => 'KUIN',
            1000 * 1000 * 1000 * 1000 * 1000 => 'KUAD',
            1000 * 1000 * 1000 * 1000 => 'T',
            1000 * 1000 * 1000 => 'M',
            1000 * 1000 => 'JT',
            1000 => 'K',
        );
        foreach($digits as $row => $str){

            $d = $digit / $row;

            if ($d >= 1) {

                $dig = number_format($d,2,',','.');

                return $dig . ' ' . $str;
            }
        }
    }
}
