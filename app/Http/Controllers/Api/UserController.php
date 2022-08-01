<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request){

        // dd($request->all());die();
        $user = User::where('email',$request->email)->first();
 
        if($user){

            $user->update([
                'fcm' => $request->fcm
            ]);
 
            if(password_verify($request->password, $user->password)){
                 return response()->json([
                     'success' => 1,
                     'message' => 'Berhasil Memuat Data'.$user->name,
                     'users' => $user
                 ]);
             }
             return $this->error('Password Salah');
 
         }
         return $this->error('Email Tidak Terdaftar');
     }
 
     public function register(Request $request){
         //name, email, password
 
         $validasi = Validator::make($request->all(),[
             'name' => 'required',
             'email' => 'required|unique:users',
             'password' => 'required|min:6'
             
 
         ]);
 
         if($validasi->fails()){
             $val = $validasi->errors()->all();
             return $this->error($val[0]);
         }
 
         $user = new User();
		if (DB::table('users')->where('email', $request->email)->first()) {
			return redirect()->back()->with('sama','-');
		}else{
			$user = new User();
			$user -> email = $request -> email;
            $user -> name = $request -> name;
			$user -> password = Hash::make($request -> password);
			$user -> level = $request->level;
			$user -> save();
			DB::table('biodata')->insert([
			'user_id'=>$user->id,
            'created_at'=>$user->created_at,
			'updated_at'=>$user->updated_at,
            ]);
		}
         
         if($user){
             return response()->json([
                 'success' => 1,
                 'message' => 'Register Berhasil',
                 'users' => $user
             ]);
         }
         return $this->error('Registrasi Gagal');   
     }
 
     public function error($pesan){
         return response()->json([
             'success' => 0,
             'message' => $pesan
         ]);
     }
}
