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
        h1,h2,h3,h4,h5,h6{
            color:black;
        }
        .divider{
            border-top: 3px double #8c8b8b;
        }
        input[type="file"]{
            color: transparent
        }
    </style>
</head>
<body>
    <div class="bg-gradient-primary">
        <div class="container" id="bcaprint">
    
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="card o-hidden border-0 shadow-lg" style="margin-top:140px;margin-bottom:140px;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="p-5" style="width:700px;">
                                <h2>PPOD Listrik</h2>
                                <br>
                                <h4>Payment BCA 
                                    <span class="float-right">
                                        @foreach ($tagihan as $row)
                                            #{{ $row->id_tagihan }}
                                        @endforeach
                                    </span>
                                </h4>
                                <hr class="divider">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h5>No Rekening</h5>
                                        <p>0192832234</p>
                                    </div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4 text-right">
                                        <h5>Pay To</h5>
                                        <p>PPOD Listrik</p>
                                        <br>
                                        <h5>Payment Method</h5>
                                        <p>BCA M-Banking</p>
                                    </div>
                                </div>
                                {{-- <h6> {{ $penggunaan->bulan.'/'.$penggunaan->tahun }}</h6> --}}
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Barang</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @php
                                            $total = 0;
                                            $total_kwh = 0;
                                        @endphp
                                        @foreach ($tagihan as $row)
                                        <tr>
                                            <td>{{ number_format($row->jumlah_meter).' KWH' }}</td>
                                            <td>{{ 'Rp.'.number_format($row->jumlah_meter * $tarif->tarif_perkwh)}}</td>
                                        </tr>
                                        @php
                                            $total += (5/100) * $row->jumlah_meter * ($row->id_tarif == 1 ? 1352 : 1467) >= 25000 ? 25000 : ((5/100) * $row->jumlah_meter * ($row->id_tarif == 1 ? 1352 : 1467) <= 5000 ? 5000 : (5/100) * $row->jumlah_meter * ($row->id_tarif == 1 ? 1352 : 1467));
                                            $total_kwh += $row->jumlah_meter * $tarif->tarif_perkwh;
                                        @endphp
                                        @endforeach
                                        <tr class="text-dark" style="font-weight:700;">
                                            <td class="font-weight-bold">Biaya Admin</td>
                                            <td class="font-weight-bold">RP.{{ number_format($total) }}</td>
                                        </tr>
                                        <tr class="text-dark" style="font-weight:700;">
                                            <td>TOTAL</td>
                                            <td>Rp.{{ number_format($total_kwh) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="float-right no-print">
                                    <a href="" class="btn btn-outline-secondary float-right" onclick="window.print()">Print</a><br><br>
                                    <form action="/payment_confirm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <small class="float-right" style="color: red">*Bukti Pengiriman </small><br>
                                        <input type="number" name="total_bayar" value="{{ $total_kwh }}" hidden>
                                        <input type="file" class="form-control-file mb-2" name="verify" style="float: right;margin-right: -50px;width:60%;" required><br>
                                        <button type="submit" class="btn btn-outline-success float-right">Confirm Payment</button>
                                    </form>
                                </div>
                                <div class="no-print">
                                    <p class="text-danger">Jika ada masalah hubungi melalui WA</p>
                                    <a href="https://api.whatsapp.com/send?phone=088704688709" class="btn btn-outline-success">Whatsapp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>