<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;


class Pembayaran extends Model
{
    use HasFactory;
    public function insert($data){
        DB::table('pembayarans')->insert($data);
    }
    public function get_pembayaran(){
        return DB::table('pembayarans')
        ->join('tagihans', 'tagihans.id_tagihan', '=', 'pembayarans.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayarans.id')
        ->get();
    }
    public function monthly($month,$year){
        $m = date('m');
        $y = date('y');
        return DB::table('pembayarans')
        ->join('tagihans', 'tagihans.id_tagihan', '=', 'pembayarans.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayarans.id')
        ->where('pembayarans.bulan',$month != NULL ? $month : $m)
        ->where('pembayarans.tahun',$year != NULL ? $year : $y)
        ->sum('pembayarans.total_bayar');
    }
    public function clean_monthly($month,$year){
        $m= date('m');
        $y = date('y');
        return DB::table('pembayarans')
        ->join('tagihans', 'tagihans.id_tagihan', '=', 'pembayarans.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayarans.id')
        ->where('pembayarans.bulan',$month != NULL ? $month : $m)
        ->where('pembayarans.tahun',$year != NULL ? $year : $y)
        ->sum('pembayarans.biaya_admin');
    }
    public function yearly($year = ''){
        $y = date('y');
        return DB::table('pembayarans')
        ->join('tagihans', 'tagihans.id_tagihan', '=', 'pembayarans.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayarans.id')
        ->where('pembayarans.tahun',$year != NULL ? $year : $y)
        ->sum('pembayarans.total_bayar');
    }
    public function clean_yearly($year = ''){
        $y = date('y');
        return DB::table('pembayarans')
        ->join('tagihans', 'tagihans.id_tagihan', '=', 'pembayarans.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayarans.id')
        ->where('pembayarans.tahun',$year != NULL ? $year : $y)
        ->sum('pembayarans.biaya_admin');
    }
    public function deleteData($id_tagihan){
        return DB::table('pembayarans')->where('id_tagihan',$id_tagihan)->delete();
    }
    public static function pembayaran_bulan($bulan,$year,$type){
        $y = date('y');
        return DB::table('pembayarans')
        ->join('tagihans', 'tagihans.id_tagihan', '=', 'pembayarans.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayarans.id')
        ->where('pembayarans.bulan',$bulan)
        ->where('pembayarans.tahun',$year != NULL ? $year : $y)
        ->where('tagihans.status','sudah_bayar')
        ->sum($type != NULL ? $type : 'pembayarans.total_bayar');
    }
    public static function pembayaran_bulan_count($bulan,$year,$type){
        return DB::table('pembayarans')
        ->join('tagihans', 'tagihans.id_tagihan', '=', 'pembayarans.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayarans.id')
        ->where('pembayarans.bulan',$bulan)
        ->where('pembayarans.tahun',$year)
        ->where('tagihans.status','sudah_bayar')
        ->count();
    }
}
