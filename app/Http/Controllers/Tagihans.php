<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tagihan;
use App\Models\User;
use App\Models\Pembayaran;

class Tagihans extends Controller
{
    public function __construct(){
        $this->Tagihan = new Tagihan;
        $this->User = new User;
        $this->Pembayaran = new Pembayaran;
    }
    public function tagihan(){
        $data['tagihan'] = $this->Tagihan->tagihan();
        return view('admin.pages.tagihan.tagihan',$data);
    }
    public function tambah(){
        $data['user'] = $this->User->get_user_data_tagihan();
        return view('admin.pages.tagihan.form_tambah',$data);
    }
    public function edit($id_tagihan){
        $data['user'] = $this->User->get_user_data_tagihan();
        $data['tagihan'] = $this->Tagihan->get_tagihan_by_id($id_tagihan);
        return view('admin.pages.tagihan.form_edit',$data);
    }
    public function insert(Request $request){

        $request->validate([
            'id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'meter_awal' => 'required',
            'meter_akhir' => 'required',
        ]);

        $data =[
            'id' => request()->id,
            'bulan' => request()->bulan,
            'tahun' => request()->tahun,
            'meter_awal' => request()->meter_awal,
            'meter_akhir' => request()->meter_akhir,
        ];
        $this->Tagihan->penggunaan_insert($data);
        
        $tagihan = $this->Tagihan->select_tagihan($data);
        
        $data_tagihan = [
            'id' => request()->id,
            'id_penggunaan' => $tagihan->id_penggunaan,
            'bulan' => request()->bulan,
            'tahun' => request()->tahun,
            'jumlah_meter' => request()->meter_akhir - request()->meter_awal,
            'status' => 'belum_bayar',
        ];
        $this->Tagihan->tagihan_insert($data_tagihan);
        if (Auth::user()->id_level == 3) {
            return redirect()->to('/bank/tagihan')->with('success','Data has been Add successfully');
        }else {
            return redirect()->to('/admin/tagihan')->with('success','Data has been Add successfully');
        }
    }
    public function update(Request $request,$id_penggunaan){

        $request->validate([
            'id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'meter_awal' => 'required',
            'meter_akhir' => 'required',
        ]);

        $data =[
            'id' => request()->id,
            'bulan' => request()->bulan,
            'tahun' => request()->tahun,
            'meter_awal' => request()->meter_awal,
            'meter_akhir' => request()->meter_akhir,
        ];
        $this->Tagihan->penggunaan_update($id_penggunaan,$data);
        
        $tagihan = $this->Tagihan->select_tagihan($data);
        
        $data_tagihan = [
            'id' => request()->id,
            'bulan' => request()->bulan,
            'tahun' => request()->tahun,
            'jumlah_meter' => request()->meter_akhir - request()->meter_awal,
            'status' => 'belum_bayar',
        ];
        $this->Tagihan->tagihan_update($id_penggunaan,$data_tagihan);
        if (Auth::user()->id_level == 3) {
            # code...
            return redirect()->to('/bank/tagihan')->with('update','Data has been updated successfully');
        } else {
            # code...
            return redirect()->to('/admin/tagihan')->with('update','Data has been updated successfully');
        }
        
    }
    public function delete($id_tagihan,$id_penggunaan){
        $this->Tagihan->deleteTagihan($id_tagihan);
        $this->Tagihan->deletePenggunaan($id_penggunaan);
        if (Auth::user()->id_level == 3) {
            # code...
            return redirect()->to('/bank/tagihan')->with('delete','Data has been deleted successfully');
        } else {
            # code...
            return redirect()->to('/admin/tagihan')->with('delete','Data has been deleted successfully');
        }
        
    }
    public function payment_confirm($id_tagihan){
        $confirm = ['status' => 'sudah_bayar'];
        $this->Tagihan->payment_confirm($confirm,$id_tagihan);
        $tagihan = $this->Tagihan->select_tagihan_payment($id_tagihan);
        $data = [
            'id_tagihan' => $tagihan->id_tagihan,
            'id' => $tagihan->id,
            'bulan' => $tagihan->bulan,
            'tahun' => $tagihan->tahun,
            'biaya_admin' => (5/100) * $tagihan->jumlah_meter * ($tagihan->id_tarif == 1 ? 1352 : 1467) >= 25000 ? 25000 : ((5/100) * $tagihan->jumlah_meter * ($tagihan->id_tarif == 1 ? 1352 : 1467) <= 5000 ? 5000 : (5/100) * $tagihan->jumlah_meter * ($tagihan->id_tarif == 1 ? 1352 : 1467)) ,
            'total_bayar' => ($tagihan->jumlah_meter * ($tagihan->id_tarif == 1 ? 1352 : 1467)),
            'paid_in' => time(),
        ];
        $this->Pembayaran->insert($data);
        if (Auth::user()->id_level == 3) {
            # code...
            return redirect()->to('/bank/tagihan')->with('success','Payment Has Been Confirm');
        } else {
            # code...
            return redirect()->to('/admin/tagihan')->with('success','Payment Has Been Confirm');
        }
        

    }
}
