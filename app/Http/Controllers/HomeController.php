<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function login()
    {
    	return view('login');
    }
    public function ceklogin(Request $request)
	{
		if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
			if (Auth::user()->level=="Petani") {
				return redirect('petani/dashboard');
			}elseif (Auth::user()->level=="Admin") {
				return redirect('admin/dashboard');
			}else{
				return redirect('/');
			}
		}else{
			return redirect()->back()->with('salah','-');
		}
	}
    public function register()
    {
    	return view('register');
    }
    public function daftar(Request $request)
	{
		$users = new User();
		if (DB::table('users')->where('email', $request->email)->first()) {
			return redirect()->back()->with('sama','-');
		}elseif ($request->confirm!==$request->password) {
			return redirect()->back()->with('confirm','-');
		}else{
			$users = new User();
			$users -> email = $request -> email;
			$users -> password = Hash::make($request -> password);
			$users -> level = $request->level;
			$users -> save();
			DB::table('biodata')->insert([
			'user_id'=>$users->id,
			'created_at'=>$users->created_at,
			'updated_at'=>$users->updated_at,
			]);
			return redirect('login')->with('yes','-');
		}
	}
	public function logout()
	{
		Auth::logout();
		return redirect('/');
	}
}
