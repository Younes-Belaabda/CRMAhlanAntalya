<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Debt;
use Validator;
use Carbon\Carbon;

class DebtController extends Controller
{
    public function __construct()
    {
       $this->middleware('IsAdmin');
    }

    public function index(Request $request)
    {
        $thisYear = date("Y");
        $thisMonth = date("m");
        $all_date = null;
        $data = Debt::select("*" , \DB::raw("DATE_FORMAT(date, '%M %Y') new_date"));
        if($request->m_user != null){
            $data = $data->where("user_id" , $request->m_user);
        }
        if($request->type != null){
            $data = $data->where("type" , $request->type);
        }
        if($request->for_id != null){
            $data = $data->where("for_id" , $request->for_id);
        }else{
            $request["for_id"]=5;
            $data = $data->where("for_id" , 5);
        }
        $all_date = $data;
        $all_date = $all_date->orderby("date" , "Desc")->get();
        
        if($request->from_date != null && $request->to_date == null){
            $data = $data->where("date" , $request->from_date);
        }
        if($request->from_date != null && $request->to_date != null){
            $data = $data->whereBetween("date" , [$request->from_date,$request->to_date]);
        }
        if($request->from_date == null && $request->to_date == null){
            $data = $data->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
        }
        $data_g = $data;
        $datas = $data->orderby("date" , "Desc")->get();
        $data_year = $data->orderby("date" , "asc")->groupby("new_date")->get();
        $data_g = $data_g->groupBy("for_id")->get();
        
        $data = $datas;
        $users = User::get();
        $users_admin = User::where("type",1)->orderby("id","DESC")->get();
        $request = $request->all();
        
        return view('panel.Debt.view' , compact('data','all_date','data_g','users','users_admin','data_year','request'));
    }

    public function change_status($id)
    {
        $partners = Debt::find($id);
        if($id != false && $partners == null){
          return redirect()->back()->with('danger' , __('Error Debt  Not Found'));
        }else{
          $partners->status = $partners->status == 1 ? '0' : '1';
          if($partners->save()){
            return redirect()->back()->with('success' , __('Success Debt Deleted'));
          }else{
            return redirect()->back()->with('danger' , __('Error Debt Not Deleted'));
          }
        }
        return redirect()->back()->with('danger' , __('Error Debt  Not Found'));
    }

    public function delete($id)
    {
        $item = Debt::find($id);
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'The deletion was successful') : $this->response_api(false, 'Error');
    }

    public function add_new($id = false)
    {
        $showDemoNotification = false;
        $showSuccesNotification  = false;
        $data = Debt::find($id);
        if($id != false && $data == null){
          return redirect()->back()->with('danger' , __('Error Debt Not Found'));
        }
        $users = User::get();
        return view('panel.Debt.add_new' , compact('data','users' , 'id' ,'showDemoNotification' ,'showSuccesNotification'));
    }

    public function save_new(Request $request ,$id = false)
    {
        $validator = Validator::make($request->all() ,[
            'price' => 'required',
            'price_type' => 'required',
            'date' => 'required',
            'for_id' => 'required',
            'status' => 'required',
        ]);

      if ($validator->fails()){
          return redirect()->back()->withInput()->withErrors($validator);
      }

      if($id){
        $item = Debt::find($id);
      }else{
        $item = new Debt;
      }
      $item->price = $request->price;
      $item->price_type = $request->price_type;
      $item->date = $request->date;
      $item->note = $request->note;
      $item->for_id = $request->for_id;
      $item->type = $request->type;
      $item->status = 1;
      $item->user_id = auth()->user()->id;
      if($item->save()){
        if($id){
        return redirect()->back()->with('success' , __('UpDated'));
        }
        return redirect()->back()->with('success' , __('Created'));
      }
      return redirect()->back()->with('danger' , __('Error Debt Not Created'));
    }


}
