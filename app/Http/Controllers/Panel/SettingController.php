<?php

namespace App\Http\Controllers\Panel;
use Illuminate\Database\Eloquent\Builder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Voucher;
use App\Models\VoucherRoom;
use App\Models\PricesTypes;
use Validator;
use Carbon\Carbon;

class SettingController extends Controller
{
    public function __construct()
    {
       //$this->middleware('IsAdmin');
    }

    public function index()
    {
        $settings = \App\Models\Setting::all();
        return view('panel.setting.view' , compact('settings'));
    }

    public function update(Request $request)
    {
        foreach($request->all() as $name => $value){
            if($value == null)
                continue;
            if($request->hasFile($name)){
                $file = $request->file($name);
                $filename = 'uploads/settings/';
                $file->move(base_path('public/' . $filename), $file->getClientOriginalName());
                $filename .= $file->getClientOriginalName();
                $setting  = \App\Models\Setting::where('name' , $name)->first();
                dd($filename);
                if($setting){
                    $setting->value = $filename;
                    $setting->save();
                }
            }else{
                $setting  = \App\Models\Setting::where('name' , $name)->first();
                if($setting){
                    $setting->value = $value;
                    $setting->save();
                }
            }
        }
        return back();
    }
}
