<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_level',
        'name',
        'email',
        'alamat',
        'nomor_kwh',
        'id_tarif',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected function level(): Attribute{
    //     return new Attribute(
    //         get:fn($value) =>['pelanggan','administrasi','bank'][$value],
    //     );
    // }

    public function get_penggunaan(){
        $id = Auth::user()->id;

        return DB::table('penggunaans')->where('id',$id)->first();
    }
    public function get_tarif(){
        $id_tarif = Auth::user()->id_tarif;

        return DB::table('tarifs')->where('id_tarif',$id_tarif)->first();
    }
    public function get_user_data(){
        return DB::table('users')
        ->join('tarifs', 'tarifs.id_tarif', '=', 'users.id_tarif')
        ->get();
    }
    public function get_user_data_tagihan(){
        return DB::table('users')
        ->join('tarifs', 'tarifs.id_tarif', '=', 'users.id_tarif')
        ->where('id_level',1)
        ->get();
    }
    public static function get_users($id){
        return DB::table('users')
        ->where('id',$id)
        ->first();
    }
}
