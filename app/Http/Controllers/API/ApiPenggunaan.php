<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penggunaan;
use App\Http\Resources\PenggunaanRes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiPenggunaan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::attempt(['email' => request()->email , 'password' => request()->password, 'id_level' => [2,3]])) {
            $penggunaan = DB::table('penggunaans')->join('users','users.id','=','penggunaans.id');
            if(request()->limit){
                $penggunaan = $penggunaan->take(request()->limit);
            }
            if(request()->bulan){
                $penggunaan = $penggunaan->where('bulan',request()->bulan);
            }
            if(request()->tahun){
                $penggunaan = $penggunaan->where('tahun',request()->tahun);
            }
            $penggunaan = $penggunaan->get();
            $penggunaanCol = PenggunaanRes::collection($penggunaan);
            return response()->json([
                'message' => $penggunaan->count() <= 0 ? 'failed' : 'success',
                'status' => $penggunaan->count() <= 0 ? 'false' : 'true',
                'data' => $penggunaanCol,
                'total'=>$penggunaan->count()
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
