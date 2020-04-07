<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Log;
use Redirect;
use Auth;
use App\User;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    protected function login(Request $data)
    {
    	if (Auth::attempt(['email' => $data->email, 'password' => $data->password])) {
            $user = User::where('email', $data->email)->first();
            Auth::login($user);
            return redirect()->to('/dashboard');
        }else{
        	return Redirect::back()->with('error_code', 2);
        }
    }

    protected function register(Request $data)
    {
    	try{
        	User::insert(['name' => $data->name, 'email' => $data->email, 'password' => bcrypt($data->password), 'api_token' => hash('sha256', Str::random(60)), 'created_at' =>  \Carbon\Carbon::now()]);
        	return redirect('/');
        }catch(Exception $e) {
		  return Redirect::back()->with('error_code', 2);
		}
        
    }

}
