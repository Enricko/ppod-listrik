<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarif;
use App\Http\Resources\TarifRes;
use Illuminate\Support\Facades\Auth;

class ApiTarif extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::attempt(['email' => request()->email , 'password' => request()->password, 'id_level' => [2,3]])) {
            $tarif = Tarif::all();

            $tarifCol = TarifRes::collection($tarif);
            return response()->json([
                'message' => $tarif->count() <= 0 ? 'failed' : 'success',
                'status' => $tarif->count() <= 0 ? 'false' : 'true',
                'data' => $tarifCol,
                'total'=>$tarif->count()
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
