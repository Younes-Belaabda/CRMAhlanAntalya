<?php

namespace App\Http\Controllers\Panel;
use Illuminate\Database\Eloquent\Builder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countries;
use Validator;
use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;




class PaymentController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    
    public function backup(Request $request){
        
        $path = storage_path()."/app/backup";
        $data = File::allFiles($path);
        $name = "backup-".Carbon::now()->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');
        $lastweak = \Carbon\Carbon::today()->subDays(7)->format('Y-m-d');
        foreach($data as $file){
            $st = false;
            $lastweaks=$lastweak;
            for($i=0;$i<=7;$i++){
                $ds = \Carbon\Carbon::parse($lastweaks)->addDay($i)->format('Y-m-d');
                if(\Str::contains($file->getFilename(), $name) == true){
                    $st = true;
                }
            }
            if($st == false){
                if(Storage::exists("/backup/".$file->getFilename())){
                  \Storage::delete("/backup/".$file->getFilename());
                }
            }
        }
        $data = File::allFiles($path);
        $request = $request->all();
        return view('panel.backup.view' , compact('data','request'));
    }
    public function Createbackup(Request $request){
        
        \Artisan::call('database:backup');
        
        return redirect()->back()->with('success' , __('Success '));
    }
    public function Downloadbackup(Request $request,$name){
        return Storage::download('backup/'.$name);
    }
    public function index(Request $request)
    {
        $thisYear = date("Y");
        $thisMonth = date("m");
        $data = Payment::orderby("id","DESC");
        if($request->name != null){
            $data = $data->where("name" ,"LIKE" , "%".$request->name."%");
        }
        if($request->from_date != null && $request->to_date != null){
            $data = $data->whereBetween("craeted_at" , [$request->from_date,$request->to_date]);
        }
        if($request->date == null && $request->from_date == null && $request->to_date == null){
            $data = $data->whereYear("craeted_at" , $thisYear)->whereMonth("craeted_at",$thisMonth);
        }
        
        $data = $data->get();
        
        $request = $request->all();
        
        return view('panel.Payment.view' , compact('data','request'));

    }
}
?>