<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleController extends Controller
{
    public function GoogleLogin(){
        return Socialite::driver('google')->redirect();
    }

    public function GoogleCallback(){
       
        try
        {
            $user= Socialite::driver('google')->user();
            $findUser =User::where('email',$user->getEmail())->first();

            if(!$findUser){
                   $userSave= User::create([
                    'name'=>$user->getName(),
                    'email'=>$user->getEmail(),
                    'password' =>'123445dummy',
                    'google_id'=>$user->getId()
                   ]);

                   Auth::login($userSave);
                   return redirect()->intended('dashbord');
                }
                else{
                    Auth::login($findUser);
                    return redirect()->intended('dashbord');
                }
               
                
            }
        
            catch(\Throwable $th){
                     dd($th->getMessage());
            }
    }
}
