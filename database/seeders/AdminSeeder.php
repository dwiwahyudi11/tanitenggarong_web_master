<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = new User;
    	$user->name = "DANTE PROJECT";
    	$user->email = "tdan3435@gmail.com";
    	$user->password = bcrypt('123');
    	$user->level = "Admin";
    	$user->save();
    	
    	DB::table('biodata')->insert([
    		'user_id'=>$user->id,
    		'nama_lengkap'=>'Dante',
    	]);
    }
}
