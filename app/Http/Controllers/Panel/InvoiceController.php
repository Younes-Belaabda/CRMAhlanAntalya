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

class InvoiceController extends Controller
{
    public function __construct()
    {
       //$this->middleware('IsAdmin');
    }

    public function print(Request $request,$id)
    {
        $data = Voucher::where("type",2)->find($id);
        $setting = PricesTypes::find(1);
        return view('panel.invoice.print' , compact('data','setting'));
    }
    
    public function index(Request $request)
    {
        if(auth()->user()->type == 1){
            $data = Voucher::where("type",2)->orderby("date","DESC")->paginate(15);
        }else{
            $data = Voucher::where("type",2)->where("user_id",auth()->user()->id)->orderby("date","DESC")->paginate(15);
        }
        $request = $request->all();
        return view('panel.invoice.view' , compact('data','request'));
    }

    public function delete($id)
    {
        $item = Voucher::find($id);
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'The deletion was successful') : $this->response_api(false, 'Error');
    }

    public function add_new($id = false)
    {
        $showDemoNotification = false;
        $showSuccesNotification  = false;
        $data = Voucher::find($id);
        if($id != false && $data == null){
          return redirect()->back()->with('danger' , __('Error Types Not Found'));
        }

        return view('panel.invoice.add_new' , compact('data' , 'id' ,'showDemoNotification' ,'showSuccesNotification'));
    }

    public function save_new(Request $request ,$id = false)
    {
        $validator = Validator::make($request->all() ,[
            'name' => 'required',
        ]);

      if ($validator->fails()){
          return redirect()->back()->withInput()->withErrors($validator);
      }

      if($id){
        $item = Voucher::find($id);
      }else{
        $item = new Voucher;
      }
      $item->type = 2;
      $item->gneder = $request->gneder;
      $item->name = $request->name;
      $item->date = $request->date;
      $item->Num = $request->Num;
      $item->cin = $request->cin;
      $item->cout = $request->cout;
      $item->status = $request->status;
      $item->hotel = $request->hotel;
      $item->address = $request->address;
      $item->b_amount = $request->b_amount;
      $item->p_amount = $request->p_amount;
      $item->note = $request->note;
        $item->user_id = auth()->user()->id;
      

      if($item->save()){
        $rooms = VoucherRoom::where("voucher_id",$item->id)->delete();
        foreach($request->rooms as $key=>$room){
            if($room != ""){
                  VoucherRoom::create([
                    "voucher_id"=>$item->id,
                    "rooms"=>$room,
                    "pax"=>$request->pax[$key],
                    "board"=>$request->board[$key],
                    "view"=>$request->view[$key],
                    "no_room"=>$request->no_room[$key],
                  ]);
            }
        }
        return redirect("/admin/invoice")->with('success' , __('invoice Created'));
      }
      return redirect()->back()->with('danger' , __('Error invoice Created'));
    }
}
