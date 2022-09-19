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
        DB::table('pembayaran')->insert($data);
    }
    public function get_pembayaran(){
        return DB::table('pembayaran')
        ->join('tagihan', 'tagihan.id_tagihan', '=', 'pembayaran.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayaran.id')
        ->get();
    }
    public function monthly($month,$year){
        $m = date('m');
        $y = date('y');
        return DB::table('pembayaran')
        ->join('tagihan', 'tagihan.id_tagihan', '=', 'pembayaran.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayaran.id')
        ->where('pembayaran.bulan',$month != NULL ? $month : $m)
        ->where('pembayaran.tahun',$year != NULL ? $year : $y)
        ->sum('pembayaran.total_bayar');
    }
    public function clean_monthly($month,$year){
        $m= date('m');
        $y = date('y');
        return DB::table('pembayaran')
        ->join('tagihan', 'tagihan.id_tagihan', '=', 'pembayaran.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayaran.id')
        ->where('pembayaran.bulan',$month != NULL ? $month : $m)
        ->where('pembayaran.tahun',$year != NULL ? $year : $y)
        ->sum('pembayaran.biaya_admin');
    }
    public function yearly($year = ''){
        $y = date('y');
        return DB::table('pembayaran')
        ->join('tagihan', 'tagihan.id_tagihan', '=', 'pembayaran.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayaran.id')
        ->where('pembayaran.tahun',$year != NULL ? $year : $y)
        ->sum('pembayaran.total_bayar');
    }
    public function clean_yearly($year = ''){
        $y = date('y');
        return DB::table('pembayaran')
        ->join('tagihan', 'tagihan.id_tagihan', '=', 'pembayaran.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayaran.id')
        ->where('pembayaran.tahun',$year != NULL ? $year : $y)
        ->sum('pembayaran.biaya_admin');
    }
    public function deleteData($id_tagihan){
        return DB::table('pembayaran')->where('id_tagihan',$id_tagihan)->delete();
    }
    public static function pembayaran_bulan($bulan,$year,$type){
        $y = date('y');
        return DB::table('pembayaran')
        ->join('tagihan', 'tagihan.id_tagihan', '=', 'pembayaran.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayaran.id')
        ->where('pembayaran.bulan',$bulan)
        ->where('pembayaran.tahun',$year != NULL ? $year : $y)
        ->where('tagihan.status','sudah_bayar')
        ->sum($type != NULL ? $type : 'pembayaran.total_bayar');
    }
    public static function pembayaran_bulan_count($bulan,$year,$type){
        return DB::table('pembayaran')
        ->join('tagihan', 'tagihan.id_tagihan', '=', 'pembayaran.id_tagihan')
        ->join('users', 'users.id', '=', 'pembayaran.id')
        ->where('pembayaran.bulan',$bulan)
        ->where('pembayaran.tahun',$year)
        ->where('tagihan.status','sudah_bayar')
        ->count();
    }
}
