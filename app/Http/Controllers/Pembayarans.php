<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class Pembayarans extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->Tagihan = new Tagihan;
        $this->User = new User;
        $this->Pembayaran = new Pembayaran;
    }
    public function pembayaran(){
        $data['pembayaran'] = $this->Pembayaran->get_pembayaran();
        return view('admin.pages.pembayaran.pembayaran',$data);
    }
    public function keliru($id_tagihan,$paid_in){
        $t = time() - $paid_in;
        if (Auth::user()->id_level == 3) {
            if ($t >= 84600) {
                return redirect()->to("/bank/pembayaran")->with('delete','Sorry Your Not Allowed To Do this!!');
            }else{
                $confirm = ['status' => 'belum_bayar'];
                $this->Tagihan->payment_confirm($confirm,$id_tagihan);
                $this->Pembayaran->deleteData($id_tagihan);
                return redirect()->to('/bank/pembayaran')->with('update','Keliru payment');
            }
        }else{
            if ($t >= 84600) {
                return redirect()->to("/admin/pembayaran")->with('delete','Sorry Your Not Allowed To Do this!!');
            }else{
                $confirm = ['status' => 'belum_bayar'];
                $this->Tagihan->payment_confirm($confirm,$id_tagihan);
                $this->Pembayaran->deleteData($id_tagihan);
                return redirect()->to('/admin/pembayaran')->with('update','Keliru payment');
            }
        }
    }
    public static function keliru_1day( $time ){

        $t = time() - $time;
            return $t ;
    }
    public static function get_time_ago( $time ){

        $time_difference = time() - $time;

        if( $time_difference < 1 ) { return 'Time Travel????'; }
        $condition = array(
                    30 * 24 * 60 * 60       =>  'month',
                    7 * 24 * 60 * 60        =>  'week',
                    7 * 24 * 60 * 60        =>  'week',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hour',
                    60                      =>  'min',
                    1                       =>  'sec'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $time_difference / $secs;

            if( $d >= 1 )
            {
                $t = round( $d );
                if($time_difference >= 604800 ){
                    return date('d-m-y h:i:s',$time);
                }else{
                    return '== '.$t . ' ' . $str . ( $t > 1 ? 's' : '' ).' ==';
                }
            }
        }
    }
}
