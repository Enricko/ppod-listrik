<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pending extends Model
{
    use HasFactory;
    public function pending_insert($verify){
        DB::table('verify')->insert($verify);
    }
    public function select_pending($verify){
        return DB::table('verify')->where($verify)->first();
    }
    public function pending(){
        return DB::table('verify')
        ->join('users','verify.id','=','users.id')
        ->get();
    }
    public function detail_tagihan($id_verify){
        return DB::table('tagihans')
        ->join('penggunaans', 'penggunaans.id_penggunaan', '=', 'tagihans.id_penggunaan')
        ->join('users', 'users.id', '=', 'tagihans.id')
        ->where('status','pending')
        ->where('id_verify',$id_verify)
        ->orderBy('tagihans.bulan','asc')
        ->orderBy('tagihans.tahun','asc')
        ->get();
    }
    public function not_valid_update($id_verify,$data){
        return DB::table('tagihans')
        ->where('id_verify',$id_verify)
        ->update($data);
    }
    public function not_valid($id_verify){
        return DB::table('verify')
        ->where('id_verify',$id_verify)
        ->delete();
    }
    public function bayar($id_verify){
        return DB::table('tagihans')
        ->where('id_verify',$id_verify)
        ->update(['status' => 'sudah_bayar','id_verify' => null]);
    }
    public function get_tagihan_by_id($id_verify){
        return DB::table('tagihans')
        ->join('users', 'users.id', '=', 'tagihans.id')
        ->where('id_verify',$id_verify)
        ->get();
    }
    public function insert_pembayaran($data){
        DB::table('pembayarans')
        ->insert($data);
    }
    public function verify_delete($id_verify){
        return DB::table('verify')
        ->where('id_verify',$id_verify)
        ->delete();
    }
}
