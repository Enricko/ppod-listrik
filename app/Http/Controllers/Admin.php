<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
        $this->User = new User;
        $this->Tagihan = new Tagihan;
        $this->Pembayaran = new Pembayaran;
    }
    public function index(){
        $year = request()->year;
        $month = request()->month;
        $type = request()->type;
        $data['type'] = request()->type;
        $data['month'] = request()->month;
        $data['year'] = request()->year;
        $data['transaksi'] = $this->Pembayaran->get_pembayaran();
        $data['pending'] = $this->Tagihan->pending();
        $data['monthly'] = $this->Pembayaran->monthly($month,$year);
        $data['clean_monthly'] = $this->Pembayaran->clean_monthly($month,$year);
        $data['yearly'] = $this->Pembayaran->yearly($year);
        $data['clean_yearly'] = $this->Pembayaran->clean_yearly($year);
        return view('admin.index',$data);
    }
    public function user(){
        $data['user'] = $this->User->get_user_data();
        return view('admin.pages.user.user',$data);
    }
    public function laporan(){
        $data['bulan'] = request()->month;
        $data['tahun'] = request()->year;
        return view('admin.laporan',$data);
    }
}