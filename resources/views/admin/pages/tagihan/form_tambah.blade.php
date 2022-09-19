@extends('admin.include.app')
@section('title','Tagihan Tambah')
@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-md-7">
                <div class="p-5">
                    <div class="text">
                        <h1 class="h4 text-gray-900 mb-4">Tambah Data Tagihan</h1>
                    </div>
                    <form class="user" action="/{{ Auth::user()->id_level == 2 ? 'admin' : 'bank' }}/tagihan/insert" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" name="id_tagihan" id="exampleInputEmail"
                                placeholder="ID" hidden >
                        </div>
                        <label for="nama">Nama Pengguna</label>
                        <div class="input-group mb-3">
                            <select name="id" id="inputGroupSelect02" class="custom-select">
                                @foreach ($user as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="inputGroupSelect02">Options</label>
                            </div>
                        </div>          
                        <label for="bulan">Bulan</label>
                        <div class="input-group mb-3">
                            <select name="bulan" id="bulan" class="custom-select">
                                @php
                                    $t = time();
                                    $m = date('m');
                                    @endphp
                                <option value="1" {{ $m == 1 ? "selected" : '' }}>January</option>
                                <option value="2" {{ $m == 2 ? "selected" : '' }}>February</option>
                                <option value="3" {{ $m == 3 ? "selected" : '' }}>March</option>
                                <option value="4" {{ $m == 4 ? "selected" : '' }}>April</option>
                                <option value="5" {{ $m == 5 ? "selected" : '' }}>May</option>
                                <option value="6" {{ $m == 6 ? "selected" : '' }}>June</option>
                                <option value="7" {{ $m == 7 ? "selected" : '' }}>July</option>
                                <option value="8" {{ $m == 8 ? "selected" : '' }}>August</option>
                                <option value="9" {{ $m == 9 ? "selected" : '' }}>September</option>
                                <option value="10" {{ $m == 10 ? "selected" : '' }}>October</option>
                                <option value="11" {{ $m == 11 ? "selected" : '' }}>November</option>
                                <option value="12" {{ $m == 12 ? "selected" : '' }}>December</option>
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="bulan">Options</label>
                            </div>
                        </div>                              
                        <label for="tahun">Tahun</label>
                        <div class="input-group mb-3">
                            <select name="tahun" id="tahun" class="custom-select">
                                @php
                                    $y = '20'.date('y');  
                                @endphp
                                <option value="{{ 2015 }}" {{ 2015 == $y ? "selected" : '' }}>{{ 2015 }}</option>
                                <option value="{{ 2016 }}" {{ 2016 == $y ? "selected" : '' }}>{{ 2016 }}</option>
                                <option value="{{ 2017 }}" {{ 2017 == $y ? "selected" : '' }}>{{ 2017 }}</option>
                                <option value="{{ 2018 }}" {{ 2018 == $y ? "selected" : '' }}>{{ 2018 }}</option>
                                <option value="{{ 2019 }}" {{ 2019 == $y ? "selected" : '' }}>{{ 2019 }}</option>
                                <option value="{{ 2020 }}" {{ 2020 == $y ? "selected" : '' }}>{{ 2020 }}</option>
                                <option value="{{ 2021 }}" {{ 2021 == $y ? "selected" : '' }}>{{ 2021 }}</option>
                                <option value="{{ 2022 }}" {{ 2022 == $y ? "selected" : '' }}>{{ 2022 }}</option>
                                <option value="{{ 2023 }}" {{ 2023 == $y ? "selected" : '' }}>{{ 2023 }}</option>
                                <option value="{{ 2024 }}" {{ 2024 == $y ? "selected" : '' }}>{{ 2024 }}</option>
                                <option value="{{ 2025 }}" {{ 2025 == $y ? "selected" : '' }}>{{ 2025 }}</option>
                                <option value="{{ 2026 }}" {{ 2026 == $y ? "selected" : '' }}>{{ 2026 }}</option>
                                <option value="{{ 2027 }}" {{ 2027 == $y ? "selected" : '' }}>{{ 2027 }}</option>
                                <option value="{{ 2028 }}" {{ 2028 == $y ? "selected" : '' }}>{{ 2028 }}</option>
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="tahun">Options</label>
                            </div>
                        </div>                              
                        {{-- <label for="tahun">Tahun</label>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" name="tahun" required="" id="tahun"
                                placeholder="tahun">
                        </div>      --}}
                        <label for="meter_awal">Meter Awal</label>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" name="meter_awal" required="" id="meter_awal"
                                placeholder="Meter Awal">
                        </div>     
                        <label for="meter_akhir">Meter Akhir</label>
                        <div class="form-group mb-5">
                            <input type="number" class="form-control form-control-user" name="meter_akhir" required="" id="meter_akhir"
                                placeholder="Meter Akhir">
                        </div>     
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection