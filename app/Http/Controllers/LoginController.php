<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Models\Partners;
use App\Models\PartnersUsers;
use App\Models\LibItemFavorites;
use App\Models\SearchItemFavorites;
use Mail;
use Carbon\Carbon;
use Artesaos\SEOTools\Facades\SEOTools;


class LoginController extends Controller
{

    public function showLoginForm()
    {
        if(Auth()->user()){
        //   if(Auth()->user()->type == 1){
        //     return redirect()->route('profile.dashboard');
        //   }
        //   if(Auth()->user()->role_id == 2 || Auth()->user()->role_id == 1){
        //     return redirect()->route('panel.dashboard');
        //   }
            return redirect()->route('panel.dashboard');
        }
        return view('panel.auth.login');
    }

    public function login(Request $request)
    {
        if($request->email == 'Team2025'){
            $request->email = 'team2025@mail.com';
        }
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|min:6',
        ]);
        $it_ch = User::where('email',$request->email)->first();
        if(isset($it_ch->status) && $it_ch->status != 1 ){
          session()->flash('danger', 'Sorry Account Not Active');
          return redirect()->back();
        }
        $credentials = ['email' => $request->email, 'password' => $request->password,'status'=>1];
        if (Auth::attempt($credentials, true)) {
            // if(auth()->user()->role_id == 3){
            //   return redirect()->route('profile.dashboard');
            // }
            return redirect()->route('panel.dashboard');
        }

        session()->flash('danger', 'Sorry Wrong Data');
        return redirect()->back();
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
      }
}
