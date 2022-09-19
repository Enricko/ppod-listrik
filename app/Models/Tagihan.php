<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Tagihan extends Model
{
    use HasFactory;

    public function tagihan(){
        return DB::table('tagihan')
        ->orderBy('status','desc')
        ->orderBy('id_tagihan','desc')
        ->join('penggunaan', 'penggunaan.id_penggunaan', '=', 'tagihan.id_penggunaan')
        ->join('users', 'users.id', '=', 'tagihan.id')
        ->where('id_level',1)
        ->get();
    }
    public function get_tagihan_by_id($id_tagihan){

        return DB::table('tagihan')
        ->join('penggunaan', 'penggunaan.id_penggunaan', '=', 'tagihan.id_penggunaan')
        ->join('users', 'users.id', '=', 'tagihan.id')
        ->where('tagihan.id_tagihan',$id_tagihan)
        ->where('tagihan.status','belum_bayar')
        ->first();
    }
    public function get_tagihan(){
        $id = Auth::user()->id;

        return DB::table('tagihan')
        ->join('penggunaan', 'penggunaan.id_penggunaan', '=', 'tagihan.id_penggunaan')
        ->join('users', 'users.id', '=', 'tagihan.id')
        ->where('users.id',$id)
        ->where('tagihan.status','belum_bayar')
        ->first();
    }
    public function get_tagihan_process(){
        $id = Auth::user()->id;

        return DB::table('tagihan')
        ->join('penggunaan', 'penggunaan.id_penggunaan', '=', 'tagihan.id_penggunaan')
        ->join('users', 'users.id', '=', 'tagihan.id')
        ->where('status','belum_bayar')
        ->where('users.id',$id)
        ->orderBy('tagihan.bulan','asc')
        ->orderBy('tagihan.tahun','asc')
        ->get();
    }
    public function get_tagihan_process_row(){
        $id = Auth::user()->id;

        return DB::table('tagihan')
        ->join('penggunaan', 'penggunaan.id_penggunaan', '=', 'tagihan.id_penggunaan')
        ->join('users', 'users.id', '=', 'tagihan.id')
        ->where('status','belum_bayar')
        ->where('users.id',$id)
        ->get();
    }
    public function pending(){
        $id = Auth::user()->id;

        return DB::table('tagihan')
        ->join('penggunaan', 'penggunaan.id_penggunaan', '=', 'tagihan.id_penggunaan')
        ->join('users', 'users.id', '=', 'tagihan.id')
        ->where('status','belum_bayar')
        ->get();
    }
    public function select_tagihan($data){
        return DB::table('penggunaan')->where($data)->first();
    }
    public function penggunaan_insert($data){
        DB::table('penggunaan')->insert($data);
    }
    public function penggunaan_update($id_penggunaan,$data){
        DB::table('penggunaan')->where('id_penggunaan',$id_penggunaan)->update($data);
    }
    public function tagihan_insert($data_tagihan){
        DB::table('tagihan')->insert($data_tagihan);
    }
    public function tagihan_update($id_penggunaan,$data_tagihan){
        DB::table('tagihan')->where('id_penggunaan',$id_penggunaan)->update($data_tagihan);
    }
    public function deletePenggunaan($id_penggunaan){
        return DB::table('penggunaan')->where('id_penggunaan',$id_penggunaan)->delete();
    }
    public function deleteTagihan($id_tagihan){
        return DB::table('tagihan')->where('id_tagihan',$id_tagihan)->delete();
    }
    public function payment_confirm($confirm,$id_tagihan){
        return DB::table('tagihan')->where('id_tagihan',$id_tagihan)->update($confirm);
    }
    public function select_tagihan_payment($id_tagihan){
        return DB::table('tagihan')
        ->join('users', 'users.id', '=', 'tagihan.id')
        ->where('id_tagihan',$id_tagihan)->first();
    }
    
}
