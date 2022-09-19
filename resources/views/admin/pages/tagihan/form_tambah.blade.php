@php
    use App\Models\Tagihan;
    use App\Http\Controllers\Tagihans;
    use App\Models\User;
    $users = request()->ids == null ? 7 : request()->ids;
    $tahun = request()->tahuns == null ? date('o') :request()->tahuns;

    function filter($users,$bulan,$tahun){
        return Tagihan::get_bulan($users,$bulan,$tahun)->count() == 0 && ("20".date('y',strtotime(User::get_users($users)->created_at)) <= $tahun ? (date('m',strtotime(User::get_users($users)->created_at)) == $bulan ? 1 : 0) : 1 ) == 0;
    }
@endphp
@extends('admin.include.app')
@section('title','Tagihan Tambah')
@section('content')
<form id="onchange" action="/{{ Auth::user()->id_level == 2 ? 'admin' : 'bank' }}/tagihan_tambah" method="POST">@csrf</form>

<form id="tambah" class="user" action="/{{ Auth::user()->id_level == 2 ? 'admin' : 'bank' }}/tagihan/insert" method="post" enctype="multipart/form-data">@csrf</form>
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-md-7">
                <div class="p-5">
                    <div class="text">
                        <h1 class="h4 text-gray-900 mb-4">Tambah Data Tagihan {{ $tahun }}</h1>
                    </div>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" name="id_tagihan" id="exampleInputEmail"
                                placeholder="ID" hidden >
                        </div>
                        <label for="nama">Nama Pengguna</label>
                        <div class="input-group mb-3">
                            <select name="ids" id="inputGroupSelect02" class="custom-select" onchange="if(this.value != 0) {this.form.submit();}" form="onchange">
                                @foreach ($user as $row)
                                <option value="{{ $row->id }}" {{ ($users != NULL ? ($users == $row->id ? "selected" : '') : '')}}>{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="inputGroupSelect02">Options</label>
                            </div>
                        </div>          
                        <input type="text" name="id" value="{{ $users }}" hidden form="tambah">
                        <label for="bulan">Bulan</label>
                        <div class="input-group mb-3">
                            <select name="bulan" id="bulan" class="custom-select" form="tambah" required>
                                @php
                                    $t = time();
                                    $m = date('m');
                                @endphp
                                @if (filter($users,1,$tahun))
                                    <option value="1" {{ $m == 1 ? "selected" : '' }}>January</option>
                                @endif
                                @if (filter($users,2,$tahun))
                                    <option value="2" {{ $m == 2 ? "selected" : '' }}>February</option>
                                @endif
                                @if (filter($users,3,$tahun))
                                    <option value="3" {{ $m == 3 ? "selected" : '' }}>March</option>
                                @endif
                                @if (filter($users,4,$tahun))
                                    <option value="4" {{ $m == 4 ? "selected" : '' }}>April</option>
                                @endif
                                @if (filter($users,5,$tahun))
                                    <option value="5" {{ $m == 5 ? "selected" : '' }}>May</option>
                                @endif
                                @if (filter($users,6,$tahun))
                                    <option value="6" {{ $m == 6 ? "selected" : '' }}>June</option>
                                @endif
                                @if (filter($users,7,$tahun))
                                    <option value="7" {{ $m == 7 ? "selected" : '' }}>July</option>
                                @endif
                                @if (filter($users,8,$tahun))
                                    <option value="8" {{ $m == 8 ? "selected" : '' }}>August</option>
                                @endif
                                @if (filter($users,9,$tahun))
                                    <option value="9" {{ $m == 9 ? "selected" : '' }}>September</option>
                                @endif
                                @if (filter($users,10,$tahun))
                                    <option value="10" {{ $m == 10 ? "selected" : '' }}>October</option>
                                @endif
                                @if (filter($users,11,$tahun))
                                    <option value="11" {{ $m == 11 ? "selected" : '' }}>November</option>
                                @endif
                                @if (filter($users,12,$tahun))
                                    <option value="12" {{ $m == 12 ? "selected" : '' }}>December</option>
                                @endif
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="bulan">Options</label>
                            </div>
                        </div>                              
                        <label for="tahun">Tahun {{ $tahun }}</label>
                        <div class="input-group mb-3">
                            <select name="tahuns" id="tahun" class="custom-select" onchange="if(this.value != 0) {this.form.submit();}" form="onchange" required>
                                @php
                                $y = '20'.date('y');  
                                @endphp
                                <option value="{{ 2015 }}" {{ ($tahun != NULL ? ($tahun == 2015 ? "selected" : '') : ( $y == 2015 ? "selected" : '' ))}}>{{ 2015 }}</option>
                                <option value="{{ 2016 }}" {{ ($tahun != NULL ? ($tahun == 2016 ? "selected" : '') : ( $y == 2016 ? "selected" : '' ))}}>{{ 2016 }}</option>
                                <option value="{{ 2017 }}" {{ ($tahun != NULL ? ($tahun == 2017 ? "selected" : '') : ( $y == 2017 ? "selected" : '' ))}}>{{ 2017 }}</option>
                                <option value="{{ 2018 }}" {{ ($tahun != NULL ? ($tahun == 2018 ? "selected" : '') : ( $y == 2018 ? "selected" : '' ))}}>{{ 2018 }}</option>
                                <option value="{{ 2019 }}" {{ ($tahun != NULL ? ($tahun == 2019 ? "selected" : '') : ( $y == 2019 ? "selected" : '' ))}}>{{ 2019 }}</option>
                                <option value="{{ 2020 }}" {{ ($tahun != NULL ? ($tahun == 2020 ? "selected" : '') : ( $y == 2020 ? "selected" : '' ))}}>{{ 2020 }}</option>
                                <option value="{{ 2021 }}" {{ ($tahun != NULL ? ($tahun == 2021 ? "selected" : '') : ( $y == 2021 ? "selected" : '' ))}}>{{ 2021 }}</option>
                                <option value="{{ 2022 }}" {{ ($tahun != NULL ? ($tahun == 2022 ? "selected" : '') : ( $y == 2022 ? "selected" : '' ))}}>{{ 2022 }}</option>
                                <option value="{{ 2023 }}" {{ ($tahun != NULL ? ($tahun == 2023 ? "selected" : '') : ( $y == 2023 ? "selected" : '' ))}}>{{ 2023 }}</option>
                                <option value="{{ 2024 }}" {{ ($tahun != NULL ? ($tahun == 2024 ? "selected" : '') : ( $y == 2024 ? "selected" : '' ))}}>{{ 2024 }}</option>
                                <option value="{{ 2025 }}" {{ ($tahun != NULL ? ($tahun == 2025 ? "selected" : '') : ( $y == 2025 ? "selected" : '' ))}}>{{ 2025 }}</option>
                                <option value="{{ 2026 }}" {{ ($tahun != NULL ? ($tahun == 2026 ? "selected" : '') : ( $y == 2026 ? "selected" : '' ))}}>{{ 2026 }}</option>
                                <option value="{{ 2027 }}" {{ ($tahun != NULL ? ($tahun == 2027 ? "selected" : '') : ( $y == 2027 ? "selected" : '' ))}}>{{ 2027 }}</option>
                                <option value="{{ 2028 }}" {{ ($tahun != NULL ? ($tahun == 2028 ? "selected" : '') : ( $y == 2028 ? "selected" : '' ))}}>{{ 2028 }}</option>
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="tahun">Options</label>
                            </div>
                        </div>     
                        <input type="number" name="tahun" value="{{ $tahun }}" hidden form="tambah">
                        {{-- <label for="tahun">Tahun</label>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" name="tahun" required="" id="tahun"
                                placeholder="tahun">
                        </div>      --}}
                        <label for="meter_awal">Meter Awal</label>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" name="meter_awal" required="" id="meter_awal"
                                placeholder="Meter Awal" form="tambah">
                        </div>     
                        <label for="meter_akhir">Meter Akhir</label>
                        <div class="form-group mb-5">
                            <input type="number" class="form-control form-control-user" name="meter_akhir" required="" id="meter_akhir"
                                placeholder="Meter Akhir" form="tambah">
                        </div>     
                        <button type="submit" class="btn btn-primary" form="tambah">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection