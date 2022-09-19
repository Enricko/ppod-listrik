<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\TagihanRes;
use Illuminate\Support\Facades\Auth;

class ApiTagihan extends Controller
{
    public function index(Request $request)
    {
        // if (Auth::attempt(['email' => request()->email , 'password' => request()->password, 'id_level' => [2,3]])) {
            
            $tagihan = DB::table('tagihans')->join('penggunaans','penggunaans.id_penggunaan','=','tagihans.id_penggunaan')->join('users','users.id','=','tagihans.id');
            if(request()->limit){
                $tagihan = $tagihan->take(request()->limit);
            }
            if(request()->bulan){
                $tagihan = $tagihan->where('tagihans.bulan',request()->bulan);
            }
            if(request()->tahun){
                $tagihan = $tagihan->where('tagihans.tahun',request()->tahun);
            }
            $tagihan = $tagihan->where('status',request()->status != null ? request()->status : 'belum_bayar')->get();
    
            $tagihanCol = TagihanRes::collection($tagihan);
            return response()->json([
                'message' => 'Access Granted',
                'status' => $tagihan->count() <= 0 ? 'false' : 'true',
                'data' => $tagihanCol,
                'total'=>$tagihan->count()
            ]);
        // }else{
        //     return response()->json([
        //         'message' => 'Access Denied You Don`t Have Access To This API !!!',
        //         'status' => 'false',
        //         'data' => [],
        //         'total'=> 0,
        //     ]);

        // }
    }

    public function single($id_tagihan){
        $tagihan = Tagihan::all()->where('id_tagihan',$id_tagihan)->where('status','sudah_bayar');
        $tagihanCol = TagihanRes::collection($tagihan);
        return response()->json([
            'message' => $tagihan->count() <= 0 ? 'failed' : 'success',
            'status' => $tagihan->count() <= 0 ? 'false' : 'true',
            'data' => $tagihanCol,
            'total'=>$tagihan->count()
        ]);
    }
}
