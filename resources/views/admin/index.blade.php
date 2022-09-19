@extends('admin.include.app')
@section('title','User Table')
@section('content')
@php
use \App\Http\Controllers\Frontend;
use \App\Models\Pembayaran;
@endphp
<style>
.line {
    width: 100%;
    height: 10px;
    border-bottom:1px solid black;
    position: absolute; 
}
</style>

<div class="container">

    <div class="d-flex justify-content-center align-items-center">
        <h1>== Welcome {{ Auth::user()->name }} ==</h1>
    </div>
    <div class="row">
    
        <div class="col-xl-8 col-lg-7 col-sm-12">
    
            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row mb-3">
                        <div class="col-8">
                            <h6 class="m-0 font-weight-bold text-primary">Total Pembayaran Listrik Tahun {{ $year != NULL ? $year : "20".date('y') }}</h6>
                        </div>
                        <div class="col-4">
                            <h6 class=" ml-3 m-0 font-weight-bold text-primary"> Transaksi Tahun {{  $year != NULL ? $year : "20".date('y')  }} ({{ $transaksi->where('tahun',$year != NULL ? $year : "20".date('y'))->count() }})</h6>
                        </div>
                    </div>
                    <form action="/{{ Auth::user()->id_level == 2 ? 'admin' : 'bank' }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <select name="type" id="" class="custom-select" onchange="if(this.value != 0) {this.form.submit();}">
                                    <option value="pembayaran.total_bayar" {{ $type != NULL ? ($type == "pembayaran.total_bayar" ? "selected" : "") : "" }}>Total Transaksi</option>
                                    <option value="pembayaran.biaya_admin" {{ $type != NULL ? ($type == "pembayaran.biaya_admin" ? "selected" : "") : "" }}>Total Biaya Admin</option>
                                    <option value="tagihan.jumlah_meter" {{ $type != NULL ? ($type == "tagihan.jumlah_meter" ? "selected" : "") : "" }}>Total KWH</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="year" id="tahun" class="custom-select" onchange="if(this.value != 0) {this.form.submit();}">
                                    @php
                                        $y = '20'.date('y');  
                                    @endphp
                                    <option value="{{ 2015 }}" {{ $year != NULL ? ($year == 2015 ? "selected" : '') : ( $y == 2015 ? "selected" : '' )}}>{{ 2015 }}</option>
                                    <option value="{{ 2016 }}" {{ $year != NULL ? ($year == 2016 ? "selected" : '') : ( $y == 2016 ? "selected" : '' )}}>{{ 2016 }}</option>
                                    <option value="{{ 2017 }}" {{ $year != NULL ? ($year == 2017 ? "selected" : '') : ( $y == 2017 ? "selected" : '' )}}>{{ 2017 }}</option>
                                    <option value="{{ 2018 }}" {{ $year != NULL ? ($year == 2018 ? "selected" : '') : ( $y == 2018 ? "selected" : '' )}}>{{ 2018 }}</option>
                                    <option value="{{ 2019 }}" {{ $year != NULL ? ($year == 2019 ? "selected" : '') : ( $y == 2019 ? "selected" : '' )}}>{{ 2019 }}</option>
                                    <option value="{{ 2020 }}" {{ $year != NULL ? ($year == 2020 ? "selected" : '') : ( $y == 2020 ? "selected" : '' )}}>{{ 2020 }}</option>
                                    <option value="{{ 2021 }}" {{ $year != NULL ? ($year == 2021 ? "selected" : '') : ( $y == 2020 ? "selected" : '' )}}>{{ 2021 }}</option>
                                    <option value="{{ 2022 }}" {{ $year != NULL ? ($year == 2022 ? "selected" : '') : ( $y == 2022 ? "selected" : '' )}}>{{ 2022 }}</option>
                                    <option value="{{ 2023 }}" {{ $year != NULL ? ($year == 2023 ? "selected" : '') : ( $y == 2023 ? "selected" : '' )}}>{{ 2023 }}</option>
                                    <option value="{{ 2024 }}" {{ $year != NULL ? ($year == 2024 ? "selected" : '') : ( $y == 2024 ? "selected" : '' )}}>{{ 2024 }}</option>
                                    <option value="{{ 2025 }}" {{ $year != NULL ? ($year == 2025 ? "selected" : '') : ( $y == 2025 ? "selected" : '' )}}>{{ 2025 }}</option>
                                    <option value="{{ 2026 }}" {{ $year != NULL ? ($year == 2026 ? "selected" : '') : ( $y == 2026 ? "selected" : '' )}}>{{ 2026 }}</option>
                                    <option value="{{ 2027 }}" {{ $year != NULL ? ($year == 2027 ? "selected" : '') : ( $y == 2027 ? "selected" : '' )}}>{{ 2027 }}</option>
                                    <option value="{{ 2028 }}" {{ $year != NULL ? ($year == 2028 ? "selected" : '') : ( $y == 2028 ? "selected" : '' )}}>{{ 2028 }}</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
    
            <!-- Bar Chart -->
            <form action="/{{ Auth::user()->id_level == 2 ? 'admin' : 'bank' }}/laporan" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-3 text-center mb-2">
                        <small class="mt-2 mL-2">Generate Laporan</small>
                    </div>
                    <div class="col-12 col-sm-3 text-center mb-2">
                        <select name="year" id="" class="custom-select">
                            <option value="{{ 2015 }}" {{ $year != NULL ? ($year == 2015 ? "selected" : '') : ( $y == 2015 ? "selected" : '' )}}>{{ 2015 }}</option>
                            <option value="{{ 2016 }}" {{ $year != NULL ? ($year == 2016 ? "selected" : '') : ( $y == 2016 ? "selected" : '' )}}>{{ 2016 }}</option>
                            <option value="{{ 2017 }}" {{ $year != NULL ? ($year == 2017 ? "selected" : '') : ( $y == 2017 ? "selected" : '' )}}>{{ 2017 }}</option>
                            <option value="{{ 2018 }}" {{ $year != NULL ? ($year == 2018 ? "selected" : '') : ( $y == 2018 ? "selected" : '' )}}>{{ 2018 }}</option>
                            <option value="{{ 2019 }}" {{ $year != NULL ? ($year == 2019 ? "selected" : '') : ( $y == 2019 ? "selected" : '' )}}>{{ 2019 }}</option>
                            <option value="{{ 2020 }}" {{ $year != NULL ? ($year == 2020 ? "selected" : '') : ( $y == 2020 ? "selected" : '' )}}>{{ 2020 }}</option>
                            <option value="{{ 2021 }}" {{ $year != NULL ? ($year == 2021 ? "selected" : '') : ( $y == 2020 ? "selected" : '' )}}>{{ 2021 }}</option>
                            <option value="{{ 2022 }}" {{ $year != NULL ? ($year == 2022 ? "selected" : '') : ( $y == 2022 ? "selected" : '' )}}>{{ 2022 }}</option>
                            <option value="{{ 2023 }}" {{ $year != NULL ? ($year == 2023 ? "selected" : '') : ( $y == 2023 ? "selected" : '' )}}>{{ 2023 }}</option>
                            <option value="{{ 2024 }}" {{ $year != NULL ? ($year == 2024 ? "selected" : '') : ( $y == 2024 ? "selected" : '' )}}>{{ 2024 }}</option>
                            <option value="{{ 2025 }}" {{ $year != NULL ? ($year == 2025 ? "selected" : '') : ( $y == 2025 ? "selected" : '' )}}>{{ 2025 }}</option>
                            <option value="{{ 2026 }}" {{ $year != NULL ? ($year == 2026 ? "selected" : '') : ( $y == 2026 ? "selected" : '' )}}>{{ 2026 }}</option>
                            <option value="{{ 2027 }}" {{ $year != NULL ? ($year == 2027 ? "selected" : '') : ( $y == 2027 ? "selected" : '' )}}>{{ 2027 }}</option>
                            <option value="{{ 2028 }}" {{ $year != NULL ? ($year == 2028 ? "selected" : '') : ( $y == 2028 ? "selected" : '' )}}>{{ 2028 }}</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-3 text-center mb-2">
                        <select name="month" id="" class="custom-select">
                            @php
                                $m = date('m');
                            @endphp
                            <option value="1" {{ $month != NULL ? ($month == 1 ? "selected" : '') : ( $m == 1 ? "selected" : '' )}}>January</option>
                            <option value="2" {{ $month != NULL ? ($month == 2 ? "selected" : '') : ( $m == 2 ? "selected" : '' )}}>February</option>
                            <option value="3" {{ $month != NULL ? ($month == 3 ? "selected" : '') : ( $m == 3 ? "selected" : '' )}}>Marc</option>
                            <option value="4" {{ $month != NULL ? ($month == 4 ? "selected" : '') : ( $m == 4 ? "selected" : '' )}}>April</option>
                            <option value="5" {{ $month != NULL ? ($month == 5 ? "selected" : '') : ( $m == 5 ? "selected" : '' )}}>May</option>
                            <option value="6" {{ $month != NULL ? ($month == 6 ? "selected" : '') : ( $m == 6 ? "selected" : '' )}}>June</option>
                            <option value="7" {{ $month != NULL ? ($month == 7 ? "selected" : '') : ( $m == 7 ? "selected" : '' )}}>July</option>
                            <option value="8" {{ $month != NULL ? ($month == 8 ? "selected" : '') : ( $m == 8 ? "selected" : '' )}}>August</option>
                            <option value="9" {{ $month != NULL ? ($month == 9 ? "selected" : '') : ( $m == 9 ? "selected" : '' )}}>September</option>
                            <option value="10" {{ $month != NULL ? ($month == 10 ? "selected" : '') : ( $m == 10 ? "selected" : '' )}}>October </option>
                            <option value="11" {{ $month != NULL ? ($month == 11 ? "selected" : '') : ( $m == 11 ? "selected" : '' )}}>November </option>
                            <option value="12" {{ $month != NULL ? ($month == 12 ? "selected" : '') : ( $m == 12 ? "selected" : '' )}}>December </option>
                        </select>
                    </div>
                    <div class="col-3 text-center mb-5">
                        <button class="btn btn-primary text-center" type="submit">Generate</button>
                    </div>
                </div>
            </form>
    
        </div>
        <div class="col-xl-4 col-lg-5 col-sm-12">
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="d-flex justify-content-center">
                            <small class="mt-2 mr-2">Select Month</small>
                            <form action="/{{ Auth::user()->id_level == 2 ? 'admin' : 'bank' }}" method="post">
                                @csrf
                                <select name="month" id="bulan" class="custom-select text-center" style="float: right;" onchange="if(this.value != 0) {this.form.submit();}">
                                    @php
                                        $t = time();
                                        $m = date('m');
                                        @endphp
                                    <option value="1" {{ $month != NULL ? ($month == 1 ? "selected" : '') : ( $m == 1 ? "selected" : '' )}}>January</option>
                                    <option value="2" {{ $month != NULL ? ($month == 2 ? "selected" : '') : ( $m == 2 ? "selected" : '' )}}>February</option>
                                    <option value="3" {{ $month != NULL ? ($month == 3 ? "selected" : '') : ( $m == 3 ? "selected" : '' )}}>Marc</option>
                                    <option value="4" {{ $month != NULL ? ($month == 4 ? "selected" : '') : ( $m == 4 ? "selected" : '' )}}>April</option>
                                    <option value="5" {{ $month != NULL ? ($month == 5 ? "selected" : '') : ( $m == 5 ? "selected" : '' )}}>May</option>
                                    <option value="6" {{ $month != NULL ? ($month == 6 ? "selected" : '') : ( $m == 6 ? "selected" : '' )}}>June</option>
                                    <option value="7" {{ $month != NULL ? ($month == 7 ? "selected" : '') : ( $m == 7 ? "selected" : '' )}}>July</option>
                                    <option value="8" {{ $month != NULL ? ($month == 8 ? "selected" : '') : ( $m == 8 ? "selected" : '' )}}>August</option>
                                    <option value="9" {{ $month != NULL ? ($month == 9 ? "selected" : '') : ( $m == 9 ? "selected" : '' )}}>September</option>
                                    <option value="10" {{ $month != NULL ? ($month == 10 ? "selected" : '') : ( $m == 10 ? "selected" : '' )}}>October </option>
                                    <option value="11" {{ $month != NULL ? ($month == 11 ? "selected" : '') : ( $m == 11 ? "selected" : '' )}}>November </option>
                                    <option value="12" {{ $month != NULL ? ($month == 12 ? "selected" : '') : ( $m == 12 ? "selected" : '' )}}>December </option>
                                </select>
                            </form>
                        </div>
                        @php
                            $bulan = array(
                                1 => 'January',2 => 'February',3 => 'March',4 => 'April',5 => 'May',6 => 'June',7 => 'July',8 => 'August',9 => 'September',10 => 'October',11 => 'November',12 => 'December',
                            );
                        @endphp
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Pendapatan Bulan {{ $bulan[$month != NULL ? $month : date('n')] }} -- {{ $year != NULL ? $year : "20".date('y') }}</div>{{-- $month!=NULL?$month: --}}
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mb-2">Rp.{{ Frontend::digits($monthly) }}</div>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Pendapatan Bulan {{ $bulan[$month != NULL ? $month : date('n')] }} -- {{ $year != NULL ? $year : "20".date('y') }} (Admin)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mb-2">Rp.{{ Frontend::digits($clean_monthly) }}</div>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Transaksi Bulan {{ $bulan[$month != NULL ? $month : date('n')] }} -- {{ $year != NULL ? $year : "20".date('y') }} = ( {{ $transaksi->where('tahun',$year != NULL ? $year : "20".date('y'))->where('bulan',$month != NULL ? $month : date('m'))->count() }} )</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Pendapatan Tahun {{ $year != NULL ? $year : "20".date('y') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mb-2">Rp.{{ Frontend::digits($yearly) }}</div>
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Pendapatan Tahun {{ $year != NULL ? $year : "20".date('y') }} (Admin)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{ Frontend::digits($clean_yearly) }}</div>
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Transaksi Tahun {{ $year != NULL ? $year : "20".date('y') }} = ( {{ $transaksi->where('tahun',$year != NULL ? $year : "20".date('y'))->count() }} )</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Pending Requests Card Example -->
                <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pending Requests</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pending->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Donut Chart -->
    
    </div>
</div>
<!-- Page level plugins -->
<script src="{{ asset('sb-admin') }}/vendor/chart.js/Chart.min.js"></script>

<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Earnings",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [
                    {{ Pembayaran::pembayaran_bulan('1',$year,$type) }},
                    {{ Pembayaran::pembayaran_bulan('2',$year,$type) }},
                    {{ Pembayaran::pembayaran_bulan('3',$year,$type) }},
                    {{ Pembayaran::pembayaran_bulan('4',$year,$type) }},
                    {{ Pembayaran::pembayaran_bulan('5',$year,$type) }},
                    {{ Pembayaran::pembayaran_bulan('6',$year,$type) }},
                    {{ Pembayaran::pembayaran_bulan('7',$year,$type) }},
                    {{ Pembayaran::pembayaran_bulan('8',$year,$type) }},
                    {{ Pembayaran::pembayaran_bulan('9',$year,$type) }},
                    {{ Pembayaran::pembayaran_bulan('10',$year,$type) }},
                    {{ Pembayaran::pembayaran_bulan('11',$year,$type) }},
                    {{ Pembayaran::pembayaran_bulan('12',$year,$type) }} ],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 12
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return '{{ ($type == 'tagihan.jumlah_meter' ? ' ' : 'Rp.')}}' + number_format(value) + '{{ ($type == 'tagihan.jumlah_meter' ? ' KWH' : '')}}';
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return [{{ $year != NULL ? $year : "20".date('y') }},'{{ ($type == 'tagihan.jumlah_meter' ? 'KWH Usage  ' : 'Earnings')}}' + ': {{ ($type == 'tagihan.jumlah_meter' ? '' : 'Rp.')}}' + number_format(tooltipItem.yLabel) + '{{ ($type == 'tagihan.jumlah_meter' ? ' KWH' : '')}}'] ;
                    }
                }
            }
        }
    });
</script>
@endsection