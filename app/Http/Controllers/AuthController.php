<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
class AuthController extends Controller
{

    public function redirect()
    {
        return response()->json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function callBackGoogle()
    {

        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->getEmail())->first();
        if (!$user) {
            $user = new User();
            $user->email = $googleUser->getEmail();
            $user->name = $googleUser->getName();
            $user->save();
        }
//create tocken and return vue.js
    }

}
