<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use Modules\Project\Entities\ProjectUser;

class JogjaController extends Controller
{
    public function masuk(Request $request)
    {

        $cek = User::where('email', $request->email)->first();

        if(is_null($cek)){
            User::create([
                'email' => $request->email,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'password' => Hash::make($request->password),
                'role_id' => 2
            ]);
        }

        Fortify::authenticateUsing(function () use($request) {
            $user = User::where('email', $request->email)->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        });
    }

    public function konfirmasi(Request $request)
    {
        $cek = ProjectUser::where('payment_code', $request->payment_code)->first();

        if(is_null($cek)){
            return response()->json("not oke", 400);
        }else{
            $cek->is_paid = 1;
            $cek->save();

            return response()->json("oke", 200);
        }
    }
}
