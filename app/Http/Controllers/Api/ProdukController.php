<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProdukController extends Controller
{
    public function produk(Request $request){
        //dd($request->all());die();
        $produk=DB::table('produk')->get();
        
        return response()->json([
            'success' => 1,
            'message' => 'Get Produk Berhasil ',
            'produk' => $produk
        ]);
    }
}
