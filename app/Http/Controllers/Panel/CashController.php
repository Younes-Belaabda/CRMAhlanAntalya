<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Income;
use App\Models\Movement;
use Validator;
use Carbon\Carbon;

class CashController extends Controller
{
    public function __construct()
    {
       $this->middleware('IsAdmin');
    }


    public static function sumAmountByCurrency($collection, $new_date, $currency)
    {
        return  $collection->where('price_type', $currency)->where('new_date', $new_date)->sum('net');
    }

    public static function ssumAmountByCurrency($collection,$type, $currency)
    {
        if($type == "Income"){
            //dd($collection->where('price_type', $currency)->where("type" , $type));
             return $collection->where('price_type', $currency)
             ->where("type" , $type)->sum('price');
        }
         //else{
            return $collection->where('price_type', $currency)
            ->where("type" , $type)->sum('price');

        //}
    }

    public static function SumByType($collection, $colum,$Sum)
    {
        $item = $collection->where('price_type', $colum)->sum($Sum);
        return $item;
    }
    public static function sumMAmountByCurrency($collection, $colum)
    {
        return $collection->where('price_type', $colum)->sum("revenue")+$collection->where('price_type', $colum)->sum("admin_partner");
    }
    public static function sumMCAmountByCurrency($collection, $colum)
    {
        return $collection->where('commission_type', $colum)->sum("commission");
    }
    public static function sumMTAmountByCurrency($collection, $colum)
    {
        return $collection->where('price_type', $colum)->sum("tax");
    }

    public function index(Request $request)
    {
        // $move = Movement::where("net_tl","!=",0)->get();
        // dd($move);
        // $data = Income::where("type","Expenses")->whereNotNull("movement_id")->get();
        // foreach($data as $item){
        //     $move = Movement::find($item->movement_id);
        //     foreach($move->users as $usr){
        //         if($usr->id == 25){
        //             dd($Ex);
        //             $Ex = Income::where("type","Expenses")->where("movement_id",$item->movement_id)->delete();
        //             //dd($Ex);
        //         }
        //     }
        // }
        // dd($data);

        $thisYear = date("Y");
        $thisMonth = date("m");

        $data_eAll = Income::
            select(
                "*",
                \DB::raw("DATE_FORMAT(date, '%M %Y') new_date")
            );

        // if($request->from_date != null && $request->to_date == null){
        //     $data_eAll = $data_eAll->where("date" , $request->from_date);
        // }
        // if($request->from_date != null && $request->to_date != null){
        //     $data_eAll = $data_eAll->whereBetween("date" , [$request->from_date,$request->to_date]);
        // }
        // if($request->from_date == null && $request->to_date == null){
            //$data_eAll = $data_eAll->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);;
            $data_eAll = $data_eAll->whereYear("date" , $thisYear);
        // }

        $data_eAll = $data_eAll->orderby("date")->whereNull("movement_id")->get();

        $movemAll = Movement::
                    select(
                        "*",
                        //'type', \DB::raw('count(*) as total'),
                        \DB::raw("DATE_FORMAT(date, '%M %Y') new_date")
                    );
        $movemAll = $movemAll->where("status" , "1");

        // if($request->from_date != null && $request->to_date == null){
        //     $movemAll = $movemAll->where("date" , $request->from_date);
        // }
        // if($request->from_date != null && $request->to_date != null){
        //     $movemAll = $movemAll->whereBetween("date" , [$request->from_date,$request->to_date]);
        // }
        // if($request->from_date == null && $request->to_date == null){
        //     $movemAll = $movemAll->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);;
        // }
        $movemAll = $movemAll->get();


        $i1=$this->ssumAmountByCurrency($data_eAll,"Income", '$');
        $i2=$this->ssumAmountByCurrency($data_eAll,"Income", 'TL');
        $i3=$this->ssumAmountByCurrency($data_eAll,"Income", '€');
        $i4=$this->ssumAmountByCurrency($data_eAll,"Income", '£');

        $m1=$this->sumMAmountByCurrency($movemAll,"$");
        $m2=$this->sumMAmountByCurrency($movemAll,"TL");
        $m3=$this->sumMAmountByCurrency($movemAll,"€");
        $m4=$this->sumMAmountByCurrency($movemAll,"£");

        $c1 = $this->sumMCAmountByCurrency($movemAll,"$");
        $c2 = $this->sumMCAmountByCurrency($movemAll,"TL");
        $c3 = $this->sumMCAmountByCurrency($movemAll,"€");
        $c4 = $this->sumMCAmountByCurrency($movemAll,"£");

        $e01 = $this->sumMTAmountByCurrency($movemAll, '$');
        $e02 = $this->sumMTAmountByCurrency($movemAll, 'TL');
        $e03 = $this->sumMTAmountByCurrency($movemAll, '€');
        $e04 = $this->sumMTAmountByCurrency($movemAll, '£');

        $e1 = $this->ssumAmountByCurrency($data_eAll,"Expenses", '$');
        $e2 = $this->ssumAmountByCurrency($data_eAll,"Expenses", 'TL');
        $e3 = $this->ssumAmountByCurrency($data_eAll,"Expenses", '€');
        $e4 = $this->ssumAmountByCurrency($data_eAll,"Expenses", '£');


        $ts1=$i1-$e1;
        $ts2=$i2-$e2;
        $ts3=$i3-$e3;
        $ts4=$i4-$e4;

        $data = Income::
            select(
                "*",
                \DB::raw("DATE_FORMAT(date, '%M %Y') new_date")
            );
        if($request->type != null){
            $data = $data->where("type" , $request->type);
        }
        if($request->from_date != null && $request->to_date == null){
            $data = $data->where("date" , $request->from_date);
        }
        if($request->from_date != null && $request->to_date != null){
            $data = $data->whereBetween("date" , [$request->from_date,$request->to_date]);
        }
        if($request->from_date == null && $request->to_date == null){
            $data = $data->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);;
        }
        if($request->for_id != null){
            $data = $data->where("for_id" , $request->for_id);
        }
        $data = $data->orderby("date");
        //$as = $data;
        $data_e = $data->whereNull("movement_id")->get();
        $data_y = $data->groupby("new_date")->get();

        $types = collect();
        $types->push("Income","Expenses");


        $movement = collect();
        $itemdata = collect();
        $movem = Movement::
                    select(
                        "*",
                        \DB::raw("DATE_FORMAT(date, '%M %Y') new_date")
                    );
        if($request->from_date != null && $request->to_date == null){
            $movem = $movem->where("date" , $request->from_date);
        }
        if($request->from_date != null && $request->to_date != null){
            $movem = $movem->whereBetween("date" , [$request->from_date,$request->to_date]);
        }
        if($request->from_date == null && $request->to_date == null){
            $data = $movem->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);;
        }
        $movement = $movem->where("status" , "1")->get();


        $users = User::get();
        $request = $request->all();
        return view('panel.Income.view' , compact('data_e','ts1','ts2','ts3','ts4','movement','data_y','types','users','request'));
    }

    public function change_status($id)
    {
        $partners = Income::find($id);
        if($id != false && $partners == null){
          return redirect()->back()->with('danger' , __('Error cash  Not Found'));
        }else{
          $partners->status = $partners->status == 1 ? '0' : '1';
          if($partners->save()){
            return redirect()->back()->with('success' , __('Success cash Deleted'));
          }else{
            return redirect()->back()->with('danger' , __('Error cash Not Deleted'));
          }
        }
        return redirect()->back()->with('danger' , __('Error cash  Not Found'));
    }

    public function delete($id)
    {
        $item = Income::find($id);
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'The deletion was successful') : $this->response_api(false, 'Error');
    }

    public function add_new($id = false)
    {
        $showDemoNotification = false;
        $showSuccesNotification  = false;
        $data = Income::find($id);
        if($id != false && $data == null){
          return redirect()->back()->with('danger' , __('Error cash Not Found'));
        }
        $users = User::get();
        return view('panel.Income.add_new' , compact('data','users' , 'id' ,'showDemoNotification' ,'showSuccesNotification'));
    }

    public function save_new(Request $request ,$id = false)
    {
        $validator = Validator::make($request->all() ,[
            'price' => 'required',
            'price_type' => 'required',
            'date' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);

      if ($validator->fails()){
          return redirect()->back()->withInput()->withErrors($validator);
      }

      if($id){
        $item = Income::find($id);
      }else{
        $item = new Income;
      }
      $item->price = $request->price;
      $item->price_type = $request->price_type;
      $item->date = $request->date;
      $item->note = $request->note;
      $item->for_id = $request->for_id;
      $item->type = $request->type;
      $item->status = $request->status;
      $item->user_id = auth()->user()->id;
      if($item->save()){

        if($id){
            return redirect()->back()->with('success' , __('UpDated'));
            }
            return redirect()->back()->with('success' , __('Created'));
      }
      return redirect()->back()->with('danger' , __('Error cash Not Created'));
    }


}
