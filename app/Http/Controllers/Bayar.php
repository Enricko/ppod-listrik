<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tagihan;
use App\Models\Pending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Bayar extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->User = new User;
        $this->Pending = new Pending;
        $this->Tagihan = new Tagihan;
    }
    public function bca(){
        $data['tagihan'] = $this->Tagihan->get_tagihan_process_row();
        $data['tarif'] = $this->User->get_tarif();
        return view('bayar.bca',$data);
    }
    public function payment_confirm(Request $request){
        $file = Request()->verify;

        $nama_file = Auth::user()->name.'-'.$file->getClientOriginalName();

        $tujuan_upload = 'images/verify';

        $file->move($tujuan_upload,$nama_file);

        $verify = [
            'id' => Auth::user()->id,
            'total_bayar' => request()->total_bayar,
            'verify_image' =>  $nama_file,
        ];
        $this->Pending->pending_insert($verify);
        $pending = $this->Pending->select_pending($verify);

        $data = [
            'status' => 'pending',
            'id_verify' => $pending->id_verify
        ];
        $this->Tagihan->pending_payment($data);
        return redirect()->to('/');
        
    }
}
