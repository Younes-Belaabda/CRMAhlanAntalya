<?php

namespace App\Http\Controllers\Panel;
use Illuminate\Database\Eloquent\Builder;

use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Notification;
use App\Models\NotificationUser;
use Validator;
use Carbon\Carbon;

class ToDoListController extends Controller
{
    public function __construct()
    {
       //$this->middleware('IsAdmin');
    }

    public function index(Request $request)
    {
        $thisYear = date("Y");
        $thisMonth = date("m");
        if(Auth()->user()->type != 1 && Auth()->user()->type != 5){
            return redirect("/");
        }
        
        $data = Notification::select("*");
        if($request->from_date != null && $request->to_date == null){
            $data = $data->where("date","Like" , "%".$request->from_date."%");
        }
        if($request->from_date != null && $request->to_date != null){
            $data = $data->whereBetween("date" , [$request->from_date,$request->to_date]);
        }
        if($request->from_date == null && $request->to_date == null){
            $data = $data->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
        }
        if($request->for_id != null){
            // $data = $data->where("from_user_id", Auth()->user()->id);
            $data = $data->wherehas("users" , function (Builder $query) use($request){
                $query->where("id" , $request->for_id);
            });
        }
        
        if(Auth()->user()->type == 5){
            $user = Auth()->user()->id;
            $data = $data->where(function ($querys) use($user) {
                $querys->wherehas("users" , function (Builder $query) use($user){
                    $query->where("id" , $user);
                })->orwhere("from_user_id", Auth()->user()->id);
            });
        }
        
        // else{
        //     // $user = Auth()->user()->id;
        //     // $data = $data->where(function ($querys) use($user) {
        //     //     $querys->wherehas("users" , function (Builder $query) use($user){
        //     //         $query->where("id" , $user);
        //     //     })->orwhere("from_user_id", Auth()->user()->id);
        //     // });
        //     // $data = $data->where("from_user_id", Auth()->user()->id);
        //     // $data = $data->wherehas("users" , function (Builder $query) use($user){
        //     //     $query->where("id" , $user);
        //     // });
            
        // }

        $data = $data->whereNull("notification_ids")->orderby("date","desc")->get();

        $users = User::get();
        $request = $request->all();
        return view('panel.todolist.view' , compact('data','users','request'));
    }

    public function change_status($id)
    {
        $partners = Notification::find($id);
        if($id != false && $partners == null){
          return redirect()->back()->with('danger' , __('Error To Do List  Not Found'));
        }else{
          $partners->status = $partners->status == 1 ? '0' : '1';
          if($partners->save()){
            return redirect()->back()->with('success' , __('Success  To Do List Deleted'));
          }else{
            return redirect()->back()->with('danger' , __('Error  To Do List Not Deleted'));
          }
        }
        return redirect()->back()->with('danger' , __('Error  To Do List  Not Found'));
    }

    public function delete($id)
    {
        $item = Notification::find($id);
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'The deletion was successful') : $this->response_api(false, 'Error');
    }

    public function add_new($id = false)
    {
        //dd("ASD");
        $showDemoNotification = false;
        $showSuccesNotification  = false;
        $data = Notification::find($id);
        if($id != false && $data == null){
          return redirect()->back()->with('danger' , __('Error  To Do List Not Found'));
        }


        $users = User::get();

        return view('panel.todolist.add_new' , compact('data','users' , 'id' ,'showDemoNotification' ,'showSuccesNotification'));
    }

    public function save_new(Request $request ,$id = false)
    {
        $validator = Validator::make($request->all() ,[
            'text' => 'required',
            'to_user_id' => 'required',
            'type' => 'required',
            //'status' => 'required',
        ]);

      if ($validator->fails()){
          return redirect()->back()->withInput()->withErrors($validator);
      }

      if($id){
        $item = Notification::find($id);
      }else{
        $item = new Notification;
      }
      $item->title = $request->title;
      $item->text = $request->text;
      $item->type = $request->type;
      $item->from_user_id = auth()->user()->id;
      //$item->to_user_id = $request->to_user_id;
      $item->status = 0;
      $item->user_id = auth()->user()->id;
      $item->date = date('Y-m-d');
      $item->save();
      
      NotificationUser::where("notification_id" , $item->notification_id)->delete();
        foreach($request->to_user_id as $nuser){
            NotificationUser::create(["notification_id"=>$item->notification_id,"user_id"=>$nuser]);
            $user = User::find($nuser);
          $title = "Notification" . $request->title;
          $text = $request->text;
            try{
                Mail::send('emails.email', ['title' => $title,'text'=>$text], function ($m) use ($user) {
                    $m->from('budget@ahlanantalya.com.tr', 'Ahlan Antalya');
                    $m->to($user->email, $user->full_name)->subject('NEW NOTFICAION');
                });
                //dd("asd");
            }catch(\Exception $e){
                return redirect()->back()->with('danger', $e->getMessage());
            }
        }
        
      
      if($item->save()){
        return redirect("/admin/todolist")->with('success' , __('User  To Do List Created'));
      }
      return redirect()->back()->with('danger' , __('Error  To Do List Not Created'));
    }

    public function add_retweet($id = false)
    {
        $showDemoNotification = false;
        $showSuccesNotification  = false;
        $data = Notification::find($id);
        
        if($data == null){
          return redirect()->back()->with('danger' , __('Error  To Do List Not Found'));
        }
        $data->status = "1";
        $data->save();
        $message = collect();
        if($id){
            $message = Notification::where("notification_id" , $id)->orwhere("notification_ids" , $id)->get();
            foreach($message as $item){
                //if($item->to_user_id == auth()->user()->id){
                    $item->status = "1";
                    $item->save();
                //}
            }
        }

        $users = User::get();

        return view('panel.todolist.add_retweet' , compact('data','message','users' , 'id' ,'showDemoNotification' ,'showSuccesNotification'));
    }

    public function save_retweet(Request $request ,$id = false)
    {
        $validator = Validator::make($request->all() ,[
            'text' => 'required',
        ]);

      if ($validator->fails()){
          return redirect()->back()->withInput()->withErrors($validator);
      }

        $data = Notification::find($id);
        
        $item = new Notification;
        $item->text = $request->text;
        $item->type = $data->type;
        $item->from_user_id = auth()->user()->id;
        //$item->to_user_id = $data->from_user_id;
        $item->notification_ids = $id;
        $item->status = 0;
        $item->user_id = auth()->user()->id;
        $item->date = date('Y-m-d');
        $item->save();
        
        
        NotificationUser::create(["notification_id"=>$item->notification_id,"user_id"=>$data->from_user_id]);
        foreach($data->users as $nuser){
            if(auth()->user()->id != $nuser->id){
                NotificationUser::create(["notification_id"=>$item->notification_id,"user_id"=>$nuser->id]);
            }
        }
        
        $data = Notification::find($item->notification_id);
        foreach($data->users as $user){
            $title = "Notification";
            $text = $request->text;
            try{
                Mail::send('emails.email', ['title' => $title,'text'=>$text], function ($m) use ($user) {
                    $m->from('budget@ahlanantalya.com.tr', 'Ahlan Antalya');
                    $m->to($user->email, $user->full_name)->subject('NOTIFICATION REPLY');
                });
                //dd("asd");
            }catch(\Exception $e){
                return redirect()->back()->with('danger', $e->getMessage());
            }
        }
        
        return redirect()->back()->with('success' , __('To Do List Retweet Created'));
    }


}
