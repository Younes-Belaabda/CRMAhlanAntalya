<?php

namespace App\Http\Controllers\Panel;
use Illuminate\Database\Eloquent\Builder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\PricesData;
use App\Models\PricesTable;
use App\Models\PricesTypes;
use App\Models\PricesTypesNote;
use Validator;
use Carbon\Carbon;

class PricesController extends Controller
{
    public function __construct()
    {
       //$this->middleware('IsAdmin');
    }

    public function setting(Request $request)
    {
        $data = PricesTypes::find(1);
        $request = $request->all();
        return view('panel.prices.setting' , compact('data','request'));
    }
    public function index(Request $request)
    {
        $data = PricesTypes::get();
        $request = $request->all();
        return view('panel.prices.view' , compact('data','request'));
    }

    public function delete($id)
    {
        $item = PricesTypes::find($id);
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'The deletion was successful') : $this->response_api(false, 'Error');
    }

    public function add_new($id = false)
    {
        $showDemoNotification = false;
        $showSuccesNotification  = false;
        $data = PricesTypes::find($id);
        if($id != false && $data == null){
          return redirect()->back()->with('danger' , __('Error Types Not Found'));
        }

        return view('panel.prices.add_new' , compact('data' , 'id' ,'showDemoNotification' ,'showSuccesNotification'));
    }

    public function save_new(Request $request ,$id = false)
    {

      if($id){
        $item = PricesTypes::find($id);
      }else{
        $item = new PricesTypes;
      }
      
      $item->title = $request->title == "" ? $item->title : $request->title;
      $item->title_page = $request->title_page == "" ? $item->title_page : $request->title_page;
      $item->desc_page = $request->desc_page == "" ? $item->desc_page : $request->desc_page;

      $item->phone = $request->phone == "" ? $item->phone : $request->phone;
      $item->email = $request->email == "" ? $item->email : $request->email;
      $item->url = $request->url == "" ? $item->url : $request->url;
      $item->address = $request->address == "" ? $item->address : $request->address;
      $item->note1 = $request->note1 == "" ? $item->note1 : $request->note1;
      $item->note2 = $request->note2 == "" ? $item->note2 : $request->note2;
      $item->note3 = $request->note3 == "" ? $item->note3 : $request->note3;
      
      if($item->save()){
          if($request->title == ""){
                return redirect("/admin/setting")->with('success' , __('Setting Saved'));
          }
        return redirect("/admin/agent")->with('success' , __('User  Types Created'));
      }
      return redirect()->back()->with('danger' , __('Error Types Created'));
    }

    
    public function Table($type_id, Request $request)
    {
        $data = PricesTable::where("type_id",$type_id)->get();
        $type = PricesTypes::find($type_id);
        $request = $request->all();
        return view('panel.prices.viewtable' , compact('data','request','type_id','type'));
    }

    public function DeleteTable($type_id,$id)
    {
        $item = PricesTable::where("type_id",$type_id)->find($id);
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'The deletion was successful') : $this->response_api(false, 'Error');
    }

    public function AddTable($type_id,$id = false)
    {
        $showDemoNotification = false;
        $showSuccesNotification  = false;
        $data = PricesTable::where("type_id",$type_id)->find($id);
        if($id != false && $data == null){
          return redirect()->back()->with('danger' , __('Error Tables Not Found'));
        }

        return view('panel.prices.add_table' , compact('data','type_id' , 'id' ,'showDemoNotification' ,'showSuccesNotification'));
    }

    public function SaveTable($type_id,Request $request ,$id = false)
    {
        $validator = Validator::make($request->all() ,[
            'title_table' => 'required',
        ]);

      if ($validator->fails()){
          return redirect()->back()->withInput()->withErrors($validator);
      }

      if($id){
        $item = PricesTable::where("type_id",$type_id)->find($id);
      }else{
        $item = new PricesTable;
      }
      $item->type_id = $type_id;
      $item->title_table = $request->title_table;
      $item->desc_table = $request->desc_table;
      
      if($item->save()){
        return redirect("/admin/agent/".$type_id."/table")->with('success' , __('User  Tables Created'));
      }
      return redirect()->back()->with('danger' , __('Error Tables Created'));
    }
    
    
    public function print(Request $request , $type_id = false)
    {
        if($type_id == 1){
            return redirect("/admin/hotels");
        }
        if($type_id == 2){
            return redirect("/admin/driver-tours");
        }
        if($type_id == 3){
            return redirect("/admin/transfers");
        }
        $url = $request->path();
        if($url == "admin/hotels"){
            $type_id = 1;
        }
        if($url == "admin/driver-tours"){
            $type_id = 2;
        }
        if($url == "admin/transfers"){
            $type_id = 3;
        }
        
        $setting = PricesTypes::find(1);
        $data = PricesTypes::find($type_id);
        $request = $request->all();
        return view('panel.prices.print' , compact('data','setting','request'));
    }

    
    public function Note($type_id, Request $request)
    {
        $data = PricesTypesNote::where("type_id",$type_id)->get();
        $request = $request->all();
        return view('panel.prices.viewnote' , compact('data','request','type_id'));
    }

    public function DeleteNote($type_id,$id)
    {
        $item = PricesTypesNote::where("type_id",$type_id)->find($id);
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'The deletion was successful') : $this->response_api(false, 'Error');
    }

    public function AddNote($type_id,$id = false)
    {
        $showDemoNotification = false;
        $showSuccesNotification  = false;
        $data = PricesTypesNote::where("type_id",$type_id)->find($id);
        if($id != false && $data == null){
          return redirect()->back()->with('danger' , __('Error Tables Not Found'));
        }

        return view('panel.prices.add_note' , compact('data','type_id' , 'id' ,'showDemoNotification' ,'showSuccesNotification'));
    }

    public function SaveNote($type_id,Request $request ,$id = false)
    {
        $validator = Validator::make($request->all() ,[
            'title' => 'required',
            'desc_note' => 'required',
        ]);

      if ($validator->fails()){
          return redirect()->back()->withInput()->withErrors($validator);
      }

      if($id){
        $item = PricesTypesNote::where("type_id",$type_id)->find($id);
      }else{
        $item = new PricesTypesNote;
      }
      $item->type_id = $type_id;
      $item->title = $request->title;
      $item->desc_note = $request->desc_note;
      
      if($item->save()){
        return redirect("/admin/agent/".$type_id."/note")->with('success' , __('User  Note Created'));
      }
      return redirect()->back()->with('danger' , __('Error Note Created'));
    }

    
    public function Data($type_id,$table_id, Request $request)
    {
        $data = PricesData::where("table_id",$table_id)->get();
        $type = PricesTypes::find($type_id);
        $table = PricesTable::find($table_id);
        $request = $request->all();
        return view('panel.prices.viewdata' , compact('data','request','type_id','table_id','type','table'));
    }

    public function DeleteData($type_id,$table_id,$id)
    {
        $item = PricesData::find($id)->where("table_id",$table_id);
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'The deletion was successful') : $this->response_api(false, 'Error');
    }

    public function AddData($type_id,$table_id,$id = false)
    {
        $showDemoNotification = false;
        $showSuccesNotification  = false;
        $data = PricesData::where("table_id",$table_id)->find($id);
        if($id != false && $data == null){
          return redirect()->back()->with('danger' , __('Error Tables Row Not Found'));
        }

        return view('panel.prices.add_data' , compact('data','type_id','table_id' , 'id' ,'showDemoNotification' ,'showSuccesNotification'));
    }

    public function SaveData($type_id,$table_id,Request $request ,$id = false)
    {
        $validator = Validator::make($request->all() ,[
            'title' => 'required',
        ]);

      if ($validator->fails()){
          return redirect()->back()->withInput()->withErrors($validator);
      }

      if($id){
        $item = PricesData::where("table_id",$table_id)->find($id);
      }else{
        $item = new PricesData;
      }
      $item->table_id = $table_id;
      $item->title = $request->title;
      $item->star = $request->star;
      $item->s5 = $request->s5;
      $item->s6 = $request->s6;
      $item->s12 = $request->s12;
      $item->s24 = $request->s24;
      $item->s50 = $request->s50;
      $item->desc_data = $request->desc_data;
      
      if($item->save()){
        return redirect("/admin/agent/".$type_id."/table/".$table_id."/row")->with('success' , __('User  Tables Created'));
      }
      return redirect()->back()->with('danger' , __('Error Tables Row Created'));
    }
}
