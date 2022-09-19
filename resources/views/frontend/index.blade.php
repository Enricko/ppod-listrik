<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PPOB Listrik</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('css') }}/app.css">
    <style>
        .text-warning-bold,
        .text-warning-bold h6{
            color: #f6c23e !important;
            font-weight: 700
        }
    </style>
</head>
<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg" style="margin-top:140px;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <?php
                        if (Auth::user()->id_level == 2 || Auth::user()->id_level == 3) {
                        ?>
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome&nbsp;{{ Auth::user()->name }}</h1>
                                        <h2>U Have Access To The Admin!</h2><br>
                                        <a href="{{ Auth::user()->id_level == 3 ? '/bank' : '/admin' }}" class="btn btn-primary">To The Admin</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="float-right">
                                    <a class="btn btn-outline-danger m-2" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        }else {
                        ?>
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome&nbsp;{{ Auth::user()->name }}</h1>
                                        <p style="font-size:18px;">Tagihan Listrik Anda</p>
                                        @if($tagihan_process->count() <= 0)
                                        <p>Belum Ada Tagihan</p>
                                        @else
                                        @php
                                            $bulan = array(
                                                1 => 'January',2 => 'February',3 => 'March',4 => 'April',5 => 'May',6 => 'June',7 => 'July',8 => 'August',9 => 'September',10 => 'October',11 => 'November',12 => 'December',
                                            );
                                        @endphp
                                        @foreach ($tagihan_process as $row)
                                        <div class="{{ $row->status == 'pending' ? 'text-warning-bold' : '' }}">
                                            <h6>Bulan {{ $bulan[$row->bulan] }}{{"($row->bulan)" }} Tahun {{ $row->tahun }}</h6>
                                            <p>{{ number_format($row->jumlah_meter).' KWH' }} = {{ 'Rp.'.number_format(($row->jumlah_meter) * $tarif->tarif_perkwh)}}</p>
                                        </div>
                                        @endforeach
                                        <p style="margin-top:15px;"><span style="font-size:18px;">Bayar Melalui : </span> 
                                            <a href="/bayar/bca" class="btn btn-outline-primary"><img src="{{ asset('images') }}/font/bca.png" alt="" style="width:50px;"></a>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="float-right">
                                    <a class="btn btn-outline-danger m-2" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>