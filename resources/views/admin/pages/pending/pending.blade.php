@extends('admin.include.app')
@section('title','Pending Table')
@section('content')

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
                            <th>Name Pengguna</th>
                            <th>Total Bayar</th>
                            <th>Verify Image</th>
                            <th>Detail Tagihan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pending as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->name }}</td>
                            <td>Rp. {{ number_format($row->total_bayar,2,',','.') }}</td>
                            <td><img src="{{ asset('images/verify/'.$row->verify_image) }}" alt="" style="width:200px;"></td>
                            <td>
                                <a href="detail_tagihan/{{ $row->name }}/{{ $row->id_verify }}" class="btn btn-primary">Detail Tagihan</a>
                            </td>
                            <td>
                                <a href="valid/{{ $row->id_verify }}/{{ $row->verify_image }}" class="btn btn-success" onclick="return confirm('Apakah verify ini sudah valid?')">Valid</a>
                                <a href="not_valid/{{ $row->id_verify }}/{{ $row->verify_image }}" class="btn btn-danger" onclick="return confirm('Apakah verify ini gk valid?')">Not Valid</a>
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