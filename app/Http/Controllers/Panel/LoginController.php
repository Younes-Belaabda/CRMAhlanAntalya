<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
        if(Auth()->user()){
          return redirect()->route('home');
        }
        $data = ['email' => "", 'password' => ''];
        return view('panel.auth.login' , compact('data'));
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $credentials = ['email' => $request->email, 'password' => $request->password,'status'=>1,'role_id'=>1];
        if (Auth::attempt($credentials, $request->has('remember'))) {
            return redirect()->route('panel.dashboard');
        }
        session()->flash('message', 'Wrong Data or Not have Manager permission');
        return redirect()->withInput()->back();

    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
      }
}
