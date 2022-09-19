<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserRes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::attempt(['email' => request()->email , 'password' => request()->password, 'id_level' => [2,3]])) {
            $user = DB::table('users')->join('levels','levels.id_level','=','users.id_level')->join('tarifs','tarifs.id_tarif','=','users.id_tarif');
            if(request()->name){
                $user = $user->find(request()->name);
            }
            if(request()->limit){
                $user = $user->take(request()->limit);
            }
            // $user = $user->where('status',request()->status != null ? request()->status : 'belum_bayar');
            $user = $user->get();
            $userCol = UserRes::collection($user);
            return response()->json([
                'message' => $user->count() <= 0 ? 'failed' : 'success',
                'status' => $user->count() <= 0 ? 'false' : 'true',
                'data' => $userCol,
                'total'=>$user->count()
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
