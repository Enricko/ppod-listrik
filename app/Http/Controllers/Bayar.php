<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Bayar extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->User = new User;
        $this->Tagihan = new Tagihan;
    }
    public function bca(){
        $data['tagihan'] = $this->Tagihan->get_tagihan_process();
        $data['tarif'] = $this->User->get_tarif();
        return view('bayar.bca',$data);
    }
    public function payment_confirm(Request $request){
        $tagihan = $this->Tagihan->get_tagihan_process();
        $tarif = $this->User->get_tarif();

        $total = 0;
        $total_kwh = 0;
        $items = "";
        $items .= "Saya ".Auth::user()->name."%0D%0A";
        $items .= "No.Rek : ".request()->rekening."%0D%0A";
        $items .= "Rekening : BCA %0D%0A";
        $items .= "================================ %0D%0A";
        foreach ($tagihan as $row){
            $items .= "Invoice :".$row->id_tagihan."%0D%0A";
            $items .= number_format($row->jumlah_meter).' KWH'."%20 || %20".'Rp.'.number_format($row->jumlah_meter * $tarif->tarif_perkwh)."%0D%0A";
            $items .= "================================ %0D%0A";
            $total += (5/100) * $row->jumlah_meter * ($row->id_tarif == 1 ? 1352 : 1467) >= 25000 ? 25000 : ((5/100) * $row->jumlah_meter * ($row->id_tarif == 1 ? 1352 : 1467) <= 5000 ? 5000 : (5/100) * $row->jumlah_meter * ($row->id_tarif == 1 ? 1352 : 1467));
            $total_kwh += $row->jumlah_meter * $tarif->tarif_perkwh;
        } 
        $items .= "Biaya Admin || Rp.".number_format($total)."%0D%0A";                          
        $items .= "TOTAL BIAYA || Rp.".number_format($total_kwh)."%0D%0A";                          

        return redirect()->to("https://api.whatsapp.com/send?phone=085876221566&text=$items");
    }
}
