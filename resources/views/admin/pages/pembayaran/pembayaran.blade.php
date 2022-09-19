<?php
use \App\Http\Controllers\Pembayarans;
use \App\Http\Controllers\Frontend;
?>
@extends('admin.include.app')
@section('title','Pembayaran Table')
@section('content')
<style>
    .popup-box {
        position: relative;
        width: 0px;
        height: 0px;
        background-color: #37444b;
        border-radius: 25px;
        transition: 0.8s;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .popup-box.content {
        min-width: 400px;
        padding: 40px;
    }
    
    .popup-box.active-popup {
        width: 400px;
        height: 250px;
        transition-delay: 0.3s;
    }
    .toggle-btn{
        width: 35px;
        height: 35px;
        background: #0bcf9c;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;    
        margin-top:20px; 
    }
    .toggle-btn::before{
        content: '+';
        font-size: 1.5em;
        color: #fff;
    }
    .popup-box .content-box{
        min-width: 400px;
        padding: 30px;
        color: #fff;
        opacity: 0;
        transition: 0.5s;
        transform: scale(0);
    }
    .popup-box.active-popup .content-box {
        opacity: 1;
        transition-delay: 0.5s;
        transform: scale(1);
    }
    .toggle-btn.active-popup {
        transform: rotate(135deg);
        background: #ff5a57;
        transition: 0.8s;
    }
    
    .info-box {
        display: flex;
        margin: 4px 4px 4px 6px;
        width: 100%;
        align-items: center;
    }
    
    h6.info-box-title {
        display: inline-block;
        width: 120px;
        color: #fff;
        font-size: 15px;
        line-height: 44px;
        font-weight: 500;
        text-transform: uppercase;
    }
    h6.info-box-subtitle {
        font-weight: 500;
        display: inline-block;
        color: #707070;
        font-size: 20px;
        word-wrap: break-word;
        width: 60%;
    }
    </style>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>
    <p class="mb-4">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Tagihan</th>
                            <th>Name Pengguna</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Total Penggunaan & Harga</th>
                            <th>Biaya Admin</th>
                            <th>Confirm/Last Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pembayaran as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->id_tagihan }}</td>
                            <td><div class="mb-1">
                                {{ $row->name }}
                            </div>
                            <div class="popup-box" id="popup-box{{ $row->id_tagihan }}">
                                <div class="content-box">
                                    <div class="info-box">
                                        <h6 class="info-box-title">Name  </h6>
                                        <h6 class="info-box-subtitle">{{ ucfirst($row->name) }}</h6>
                                    </div>
                                    <div class="info-box">
                                        <h6 class="info-box-title">Email  </h6>
                                        <h6 class="info-box-subtitle">{{ $row->email }} </h6>
                                    </div>
                                    <div class="info-box">
                                        <h6 class="info-box-title">Nomor Kwh  </h6>
                                        <h6 class="info-box-subtitle">{{ $row->nomor_kwh }} </h6>
                                    </div>
                                    <div class="info-box">
                                        <h6 class="info-box-title">Nomor Kwh  </h6>
                                        <h6 class="info-box-subtitle">{{ $row->id_tarif == 1 ? 'Rp.1.352' : 'Rp.1.467' }} </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="toggle-btn" id="toggle-btn{{ $row->id_tagihan }}"></div>
                            </div>
                            <script>
                                let toggleBtn{{ $row->id_tagihan }} = document.querySelector('#toggle-btn{{ $row->id_tagihan }}');
                                let popupBox{{ $row->id_tagihan }} = document.querySelector('#popup-box{{ $row->id_tagihan }}');
                                toggleBtn{{ $row->id_tagihan }}.onclick = function() {
                                    popupBox{{ $row->id_tagihan }}.classList.toggle('active-popup')
                                    toggleBtn{{ $row->id_tagihan }}.classList.toggle('active-popup')
                                }
                            </script></td>
                            <td>{{ $row->bulan }}</td>
                            <td>{{ $row->tahun }}</td>
                            <td>{{ Frontend::digits($row->jumlah_meter).' KWH' }} = Rp.{{ Frontend::digits($row->jumlah_meter * ($row->id_tarif == 1 ? 1352 : 1467)) }}</td>
                            <td>Rp.{{ number_format($row->biaya_admin) }}</td>
                            <td>
                            @php
                                $Date = Pembayarans::keliru_1day($row->paid_in);
                                $Ago = Pembayarans::get_time_ago($row->paid_in);
                            @endphp
                            @if ($Date >= 86400)
                            <p style="width:120px;">{{ $Ago }}</p>                               
                            @else
                                {{ $Ago }}<br>
                                <a href="/{{ Auth::user()->id_level == 2 ? 'admin' : 'bank' }}/pembayaran/keliru/{{ $row->id_tagihan }}/{{ $row->paid_in }}" class="btn btn-warning" onclick="return confirm('Apa anda yakin?')">Keliru</a>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>    
@endsection