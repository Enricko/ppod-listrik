<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PembayaranRes;
use Illuminate\Support\Facades\Auth;

class ApiPembayaran extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::attempt(['email' => request()->email , 'password' => request()->password, 'id_level' => [2,3]])) {
            $pembayaran = DB::table('pembayarans')->join('tagihans','tagihans.id_tagihan','=','pembayarans.id_tagihan')->join('users','users.id','=','pembayarans.id');
            if(request()->limit){
                $pembayaran = $pembayaran->take(request()->limit);
            }
            if(request()->bulan){
                $pembayaran = $pembayaran->where('bulan',request()->bulan);
            }
            if(request()->tahun){
                $pembayaran = $pembayaran->where('tahun',request()->tahun);
            }
            $pembayaran = $pembayaran->get();
            $pembayaranCol = PembayaranRes::collection($pembayaran);
            return response()->json([
                'message' => $pembayaran->count() <= 0 ? 'failed' : 'success',
                'status' => $pembayaran->count() <= 0 ? 'false' : 'true',
                'data' => $pembayaranCol,
                'total'=>$pembayaran->count()
            ]);
        }else{
            return response()->json([
                'message' => 'Access Denied You Don`t Have Access To This API !!!',
                'status' => 'false',
                'data' => [],
                'total'=> 0,
            ]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
