<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pending;
use Illuminate\Support\Facades\Auth;

class Pendings extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->Pending = new Pending;
    }
    public function pending(){
        $data['pending'] = $this->Pending->pending();
        return view('admin.pages.pending.pending',$data);
    }
    public function detail_tagihan($name,$id_verify){
        $data['detail_tagihan'] = $this->Pending->detail_tagihan($id_verify);
        $data['name'] = $name;
        return view('admin.pages.pending.detail_tagihan',$data);
    }
    public function not_valid($id_verify,$verify_image){
        $image = 'images/verify/'.$verify_image;
        if (file_exists($image)) {
            unlink($image);
        }
        $data = [
            'id_verify' => null,
            'status' => 'belum_bayar'
        ];
        $this->Pending->not_valid_update($id_verify,$data);
        $this->Pending->not_valid($id_verify);
        if (Auth::user()->id_level == 3) {
            # code...
            return redirect()->to('/bank/pending')->with('delete','Verify is not valid');
        } else {
            # code...
            return redirect()->to('/admin/pending')->with('delete','Verify is not valid');
        }
    }
    public function valid($id_verify,$verify_image){
        $pembayaran = $this->Pending->get_tagihan_by_id($id_verify);

        foreach($pembayaran as $row){
            $data = [
                'id_tagihan' => $row->id_tagihan,
                'id' => $row->id,
                'bulan' => $row->bulan,
                'tahun' => $row->tahun,
                'biaya_admin' => (5/100) * $row->jumlah_meter * ($row->id_tarif == 1 ? 1352 : 1467) >= 25000 ? 25000 : ((5/100) * $row->jumlah_meter * ($row->id_tarif == 1 ? 1352 : 1467) <= 5000 ? 5000 : (5/100) * $row->jumlah_meter * ($row->id_tarif == 1 ? 1352 : 1467)),
                'total_bayar' => ($row->jumlah_meter * ($row->id_tarif == 1 ? 1352 : 1467)),
                'paid_in' => time(),
                'verify_image' => $verify_image
            ];
            $this->Pending->insert_pembayaran($data);
        }
        $this->Pending->bayar($id_verify);
        $this->Pending->verify_delete($id_verify);
        if (Auth::user()->id_level == 3) {
            # code...
            return redirect()->to('/bank/pending')->with('success','Verify is valid');
        } else {
            # code...
            return redirect()->to('/admin/pending')->with('success','Verify is valid');
        }
    }
}
