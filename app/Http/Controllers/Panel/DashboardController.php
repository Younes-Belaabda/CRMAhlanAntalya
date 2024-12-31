<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $pid = null;
        $user = Auth()->user();
        if($user->type == 2 || $user->type == 3 || $user->type == 4 || $user->type == 5){
            return redirect('/admin/entries?d_user='.$user->id);
        }
         return redirect('/admin/entries');
        return view('panel.dashboard' , compact('pid'));
    }

}
