@php
    use \App\models\Pembayaran;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    
    <link href="{{ asset('sb-admin') }}/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="{{ asset('sb-admin') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <style>
        hr.divider-laporan {
    border-top: 3px double #8c8b8b;
}
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <h1>Laporan Bulan {{ $bulan }} | Tahun {{ $tahun }}</h1>
        </div>
        <div class="text-center mt-5">
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-bold">Total Transaksi</h5>
                <h5>Rp.{{ number_format(Pembayaran::pembayaran_bulan($bulan,$tahun,'pembayaran.total_bayar')) }}</h5>
            </div>
            <hr class="divider-laporan">
            <div class="d-flex justify-content-between mt-4">
                <h5 class="font-weight-bold">Total Biaya Admin</h5>
                <h5>Rp.{{ number_format(Pembayaran::pembayaran_bulan($bulan,$tahun,'pembayaran.biaya_admin')) }}</h5>
            </div>
            <hr class="divider-laporan">
            <div class="d-flex justify-content-between mt-4">
                <h5 class="font-weight-bold">Total KWH</h5>
                <h5>{{ number_format(Pembayaran::pembayaran_bulan($bulan,$tahun,'tagihan.jumlah_meter')) }} KWH</h5>
            </div>
            <hr class="divider-laporan">
            <div class="d-flex justify-content-between mt-4">
                <h5 class="font-weight-bold">Total Transaksi</h5>
                <h5>{{ number_format(Pembayaran::pembayaran_bulan_count($bulan,$tahun,'tagihan.jumlah_meter')) }} <i class="fas fa-users"></i></h5>
            </div>
            <hr class="divider-laporan">
            <div class="d-flex justify-content-between mt-4">
                <h5 class="font-weight-bold">Total Transaksi di Banding Bulan Lalu %</h5>
                @php
                    $bulan_persen = ($bulan == '1' ? "12" : $bulan - 1);
                @endphp
                <h5>
                    <i class="fas fa-angle-double-{{ ((Pembayaran::pembayaran_bulan($bulan,$tahun,'pembayaran.total_bayar') - Pembayaran::pembayaran_bulan($bulan_persen,$tahun,'pembayaran.total_bayar') && Pembayaran::pembayaran_bulan ($bulan_persen,$tahun,'pembayaran.total_bayar'))  == 0 ? '0' : ((Pembayaran::pembayaran_bulan($bulan,$tahun,'pembayaran.total_bayar') - Pembayaran::pembayaran_bulan( $bulan_persen,$tahun,'pembayaran.total_bayar'))/ Pembayaran::pembayaran_bulan($bulan_persen,$tahun,'pembayaran.total_bayar')) * 100) < 0 ? 'down' : 'up' }}" style='color: {{ ((Pembayaran::pembayaran_bulan($bulan,$tahun,'pembayaran.total_bayar') - Pembayaran::pembayaran_bulan($bulan_persen,$tahun,'pembayaran.total_bayar') && Pembayaran::pembayaran_bulan ($bulan_persen,$tahun,'pembayaran.total_bayar'))  == 0 ? '0' : ((Pembayaran::pembayaran_bulan($bulan,$tahun,'pembayaran.total_bayar') - Pembayaran::pembayaran_bulan( $bulan_persen,$tahun,'pembayaran.total_bayar'))/ Pembayaran::pembayaran_bulan($bulan_persen,$tahun,'pembayaran.total_bayar')) * 100) < 0 ? 'red' : 'green'}};'></i>
                    {{-- {{ ((Pembayaran::pembayaran_bulan($bulan,$tahun,'pembayaran.total_bayar') - Pembayaran::pembayaran_bulan($bulan_persen,$tahun,'pembayaran.total_bayar') && Pembayaran::pembayaran_bulan ($bulan_persen,$tahun,'pembayaran.total_bayar'))  == 0 ? '0' : ((Pembayaran::pembayaran_bulan($bulan,$tahun,'pembayaran.total_bayar') - Pembayaran::pembayaran_bulan( $bulan_persen,$tahun,'pembayaran.total_bayar'))/ Pembayaran::pembayaran_bulan($bulan_persen,$tahun,'pembayaran.total_bayar')) * 100) < 0 ? $down : $up}} --}}
                    {{ number_format((Pembayaran::pembayaran_bulan($bulan,$tahun,'pembayaran.total_bayar') - Pembayaran::pembayaran_bulan($bulan_persen,$tahun,'pembayaran.total_bayar') && Pembayaran::pembayaran_bulan ($bulan_persen,$tahun,'pembayaran.total_bayar'))  == 0 ? '0' : ((Pembayaran::pembayaran_bulan($bulan,$tahun,'pembayaran.total_bayar') - Pembayaran::pembayaran_bulan( $bulan_persen,$tahun,'pembayaran.total_bayar'))/ Pembayaran::pembayaran_bulan($bulan_persen,$tahun,'pembayaran.total_bayar')) * 100) }} %</h5>
            </div>
            <hr class="divider-laporan">
            <div class="d-flex justify-content-between mt-4">
                <h5 class="font-weight-bold">Total Biaya Admin di Banding Bulan Lalu %</h5>
                
                <h5>{{ number_format((Pembayaran::pembayaran_bulan($bulan,$tahun,'pembayaran.biaya_admin') - Pembayaran::pembayaran_bulan($bulan_persen,$tahun,'pembayaran.biaya_admin') && Pembayaran::pembayaran_bulan($bulan_persen,$tahun,'pembayaran.biaya_admin')) == 0 ? '0' : ((Pembayaran::pembayaran_bulan($bulan,$tahun,'pembayaran.biaya_admin') - Pembayaran::pembayaran_bulan($bulan_persen,$tahun,'pembayaran.biaya_admin')) / Pembayaran::pembayaran_bulan($bulan_persen,$tahun,'pembayaran.biaya_admin')) * 100) }} %</h5>
            </div>
            <hr class="divider-laporan">
        </div>
    </div>
</body>
</html>