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
        return DB::table('tagihans')
        ->orderBy('status','desc')
        ->orderBy('id_tagihan','desc')
        ->join('penggunaans', 'penggunaans.id_penggunaan', '=', 'tagihans.id_penggunaan')
        ->join('users', 'users.id', '=', 'tagihans.id')
        ->where('id_level',1)
        ->get();
    }
    public function pending_payment($data){
        return DB::table('tagihans')
        ->where('id',Auth::user()->id)
        ->where('status','belum_bayar')
        ->update($data);
    }
    public function get_tagihan_by_id($id_tagihan){

        return DB::table('tagihans')
        ->join('penggunaans', 'penggunaans.id_penggunaan', '=', 'tagihans.id_penggunaan')
        ->join('users', 'users.id', '=', 'tagihans.id')
        ->where('tagihans.id_tagihan',$id_tagihan)
        ->where('tagihans.status','belum_bayar')
        ->first();
    }
    public function get_tagihan(){
        $id = Auth::user()->id;

        return DB::table('tagihans')
        ->join('penggunaans', 'penggunaans.id_penggunaan', '=', 'tagihans.id_penggunaan')
        ->join('users', 'users.id', '=', 'tagihans.id')
        ->where('users.id',$id)
        ->where('tagihans.status','belum_bayar')
        ->first();
    }
    public function get_tagihan_process(){
        $id = Auth::user()->id;

        return DB::table('tagihans')
        ->join('penggunaans', 'penggunaans.id_penggunaan', '=', 'tagihans.id_penggunaan')
        ->join('users', 'users.id', '=', 'tagihans.id')
        ->where('status','!=','sudah_bayar')
        ->where('users.id',$id)
        ->orderBy('tagihans.bulan','asc')
        ->orderBy('tagihans.tahun','asc')
        ->get();
    }
    public function get_tagihan_process_row(){
        $id = Auth::user()->id;

        return DB::table('tagihans')
        ->join('penggunaans', 'penggunaans.id_penggunaan', '=', 'tagihans.id_penggunaan')
        ->join('users', 'users.id', '=', 'tagihans.id')
        ->where('status','!=','sudah_bayar')
        ->where('status','!=','pending')
        ->where('users.id',$id)
        ->get();
    }
    public function pending(){
        $id = Auth::user()->id;

        return DB::table('tagihans')
        ->join('penggunaans', 'penggunaans.id_penggunaan', '=', 'tagihans.id_penggunaan')
        ->join('users', 'users.id', '=', 'tagihans.id')
        ->where('status','belum_bayar')
        ->get();
    }
    public function select_tagihan($data){
        return DB::table('penggunaans')->where($data)->first();
    }
    public function penggunaan_insert($data){
        DB::table('penggunaans')->insert($data);
    }
    public function penggunaan_update($id_penggunaan,$data){
        DB::table('penggunaans')->where('id_penggunaan',$id_penggunaan)->update($data);
    }
    public function tagihan_insert($data_tagihan){
        DB::table('tagihans')->insert($data_tagihan);
    }
    public function tagihan_update($id_penggunaan,$data_tagihan){
        DB::table('tagihans')->where('id_penggunaan',$id_penggunaan)->update($data_tagihan);
    }
    public function deletePenggunaan($id_penggunaan){
        return DB::table('penggunaans')->where('id_penggunaan',$id_penggunaan)->delete();
    }
    public function deleteTagihan($id_tagihan){
        return DB::table('tagihans')->where('id_tagihan',$id_tagihan)->delete();
    }
    public function payment_confirm($confirm,$id_tagihan){
        return DB::table('tagihans')->where('id_tagihan',$id_tagihan)->update($confirm);
    }
    public function select_tagihan_payment($id_tagihan){
        return DB::table('tagihans')
        ->join('users', 'users.id', '=', 'tagihans.id')
        ->where('id_tagihan',$id_tagihan)->first();
    }
    public static function get_bulan($users,$bulan,$tahun){
        return DB::table('tagihans')
        ->where('id',$users)
        ->where('bulan',$bulan)
        ->where('tahun',$tahun)
        ->get();
    }
}
