<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Countries;
use Validator;
use Carbon\Carbon;

class CountriesController extends Controller
{
    public function __construct()
    {
       $this->middleware('IsAdmin');
    }

    public function index()
    {
        $data = Countries::get();
        return view('panel.Countries.view' , compact('data'));
    }

    public function change_status($id)
    {
        $partners = Countries::find($id);
        if($id != false && $partners == null){
          return redirect()->back()->with('danger' , __('Error Countries  Not Found'));
        }else{
          $partners->status = $partners->status == 1 ? '0' : '1';
          if($partners->save()){
            return redirect()->back()->with('success' , __('Success Countries Deleted'));
          }else{
            return redirect()->back()->with('danger' , __('Error Countries Not Deleted'));
          }
        }
        return redirect()->back()->with('danger' , __('Error Countries  Not Found'));
    }

    public function delete($id)
    {
        $item = Countries::find($id);
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'The deletion was successful') : $this->response_api(false, 'Error');
    }

    public function add_new($id = false)
    {
        $showDemoNotification = false;
        $showSuccesNotification  = false;
        $data = Countries::find($id);
        if($id != false && $data == null){
          return redirect()->back()->with('danger' , __('Error User Countries Not Found'));
        }
        return view('panel.Countries.add_new' , compact('data' , 'id' ,'showDemoNotification' ,'showSuccesNotification'));
    }

    public function save_new(Request $request ,$id = false)
    {
        $validator = Validator::make($request->all() ,[
            'name' => 'required|max:255',
            'status' => 'required',
        ]);

      if ($validator->fails()){
          return redirect()->back()->withInput()->withErrors($validator);
      }

      if($id){
        $item = Countries::find($id);
      }else{
        $item = new Countries;
      }
      $item->name = $request->name;
      $item->status = $request->status;
      $item->user_id = auth()->user()->id;
      
      if(isset($request->file)) {
        $fileName = time().'_'.$request->file->getClientOriginalName();
        $request->file->move('public/images', $fileName);
        $item->image = $fileName;
      }
      
      if($item->save()){
        if($id){
        return redirect()->back()->with('success' , __('UpDated'));
        }
        return redirect()->back()->with('success' , __('Created'));
      }
      return redirect()->back()->with('danger' , __('Error User Countries Not Created'));
    }


}
