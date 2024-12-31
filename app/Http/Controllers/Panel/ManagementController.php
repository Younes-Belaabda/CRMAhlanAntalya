<?php

namespace App\Http\Controllers\Panel;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Movement;
use App\Models\Income;
use App\Models\Partners;
use App\Models\UsersBalance;
use Validator;
use Carbon\Carbon;

class ManagementController extends Controller
{
    public function __construct()
    {
       $this->middleware('IsAdmin');
    }

    public function index(Request $request)
    {
        $items = collect();
        $data = User::orderby("type" , "ASC");
        
        if(isset($request->type) && $request->type != null){
            //$data = $data->where("type" , $request->type);
        }else{
            $request["type"] = 1;
        }
        
        $data = $data->get();
        foreach($data as $item){
            if($item->type == 3){
                
                $incs =  Income::where("for_id",$item->id)->where("price_type","$")->whereNull("movement_id")->get();
                $b1 = 0;
                $b2 = 0;
                foreach($incs as $inc){
                    if($inc->movement_id == null && $inc->type == "Income"){
                        $b1 += $inc->price;
                    }else{
                        $b1 -= $inc->price;
                    }
                }
                
                
                $moves =  Movement::wherehas("users" , function (Builder $query) use($item){
                    $query->where("id" , $item->id);
                })
                ->where("price_type" , "$");
                $t1 = $moves;
                $t2 = $moves;
                $t2 = $t2->sum("revenue_partner");
                $t1 = $t1->where("paybyus" , "1")->sum("price");
                
                
                // if($moves->count() == 0){
                //     $movesw =  Movement::wherehas("users" , function (Builder $query) use($item){
                //         $query->where("id" , $item->id);
                //     })
                //     ->where("status","1")
                //     ->where("price_type" , "$")->sum("revenue_partner");
                //     $t2 = $t2 - $movesw;
                // }

                $item->blance = ($b1+$t2)-($b2+$t1);
            }
        }
        
        $request = $request->all();
        $user_type = collect();
        $user_type->push("Admin","Driver","Agent","Vendor","Partner");
        
        return view('panel.Management.view' , compact('data','user_type','request'));
    }

    public function change_status($id)
    {
        $partners = User::find($id);
        if($id != false && $partners == null){
          return redirect()->back()->with('danger' , __('Error User  Not Found'));
        }else{
          $partners->status = $partners->status == 1 ? '0' : '1';
          if($partners->save()){
            return redirect()->back()->with('success' , __('Success User Deleted'));
          }else{
            return redirect()->back()->with('danger' , __('Error User Not Deleted'));
          }
        }
        return redirect()->back()->with('danger' , __('Error User  Not Found'));
    }

    public function delete($id)
    {
        $item = User::find($id);
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'The deletion was successful') : $this->response_api(false, 'Error');
    }

    public function add_new($id = false)
    {
        $showDemoNotification = false;
        $showSuccesNotification  = false;
        $data = User::find($id);
        if($id != false && $data == null){
          return redirect()->back()->with('danger' , __('Error User Account Not Found'));
        }
        return view('panel.Management.add_new' , compact('data' , 'id' ,'showDemoNotification' ,'showSuccesNotification'));
    }

    public function save_new(Request $request ,$id = false)
    {
      if($id){
        $validator = Validator::make($request->all() ,[
            'user_name' => 'required|max:255|unique:users,user_name,'.$id,
            'email' => 'required',
            'full_name' => 'required',
            'status' => 'required',
        ]);
      }else{
        $validator = Validator::make($request->all() ,[
            'user_name' => 'required|max:255|unique:users,user_name,'.$id,
            'email' => 'required',
            'full_name' => 'required',
            'password' => 'required|required_with:password_confirmation|confirmed|min:8',
            'password_confirmation' => 'required',
            'status' => 'required',
        ]);
      }
      if ($validator->fails()){
          return redirect()->back()->withInput()->withErrors($validator);
      }
      $data = $request->all();
      $data['id'] = $id;
      //dd($data);
      if($id &&  $data['password'] == null){
        unset($data['password']);
      }
      if(isset($data['password']) && $data['password'] != null){
        $data['password'] = bcrypt($data['password']);
      }

      //dd($data);
      if(isset($request->file)) {
        $fileName = time().'_'.$request->file->getClientOriginalName();
        $request->file->move('public/images', $fileName);
        $data['image'] = $fileName;
      }
      //dd($data);
      $item = User::store($data);

      if($item){
        if($id){
        return redirect()->back()->with('success' , __('UpDated'));
        }
        return redirect()->back()->with('success' , __('Created'));
      }
      return redirect()->back()->with('danger' , __('Error User Account Not Created'));
    }

    public function add_balance(Request $request ,$id)
    {
        $thisYear = date("Y");
        $thisMonth = date("m");
        $user = User::find($id);
        if($id && $user == null){
          return redirect()->back()->with('danger' , __('Error User Account Not Found'));
        }
        
        $types = collect();
        $types->push("Income","Expenses");
        
        $data = Income::
            select(
                "*",
                \DB::raw("DATE_FORMAT(date, '%M %Y') new_date")
            );
            
        if($request->from_date != null && $request->to_date == null){
            $data = $data->where("date" , $request->from_date);
        }
        if($request->from_date != null && $request->to_date != null){
            $data = $data->whereBetween("date" , [$request->from_date,$request->to_date]);
        }

        if($request->from_date == null && $request->to_date == null){
            $data = $data->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
        }
        
        $data = $data->orderby("new_date" , "DESC");
        $data_e = $data->where("for_id" , $id)->get();
        //dd($data_e);
        $data_y = $data->where("for_id" , $id)->where("type","Income")->groupby("new_date")->get();
        
        $moves =  Movement::select("*",\DB::raw("DATE_FORMAT(date, '%M %Y') new_date"))
                ->wherehas("users" , function (Builder $query) use($user){
                    $query->where("id" , $user->id);
                })
                ->where("price_type" , "$");
                
        if($request->from_date != null && $request->to_date == null){
            $moves = $moves->where("date" , $request->from_date);
        }
        if($request->from_date != null && $request->to_date != null){
            $moves = $moves->whereBetween("date" , [$request->from_date,$request->to_date]);
        }

        if($request->from_date == null && $request->to_date == null){
            $moves = $moves->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
        }
        
        
        $moves_data = $moves->orderby("date" , "asc")->get();
        $moves_data_year = $moves->groupby("new_date")->get();
        //$balances = UsersBalance::where("for_id" , $id)->get();
        $balances = collect();
        
        $state = collect();
        $state->push("1","0");
        
       $request = $request->all();
       
            if($user->type == 3){
                $incs =  Income::where("for_id",$user->id)->where("price_type","$")->get();
                $b1 = 0;
                $b2 = 0;
                foreach($incs as $inc){
                    if($inc->movement_id == null){
                        $b1 += $inc->price;
                    }
                }
                
                $moves =  Movement::wherehas("users" , function (Builder $query) use($user){
                    $query->where("id" , $user->id);
                })
                ->where("price_type" , "$");
                $t1 = $moves;
                $t2 = $moves;
                $t2 = $t2->sum("revenue_partner");
                $t1 = $t1->where("paybyus" , "1")->sum("price");

                $user->blance = ($b1+$t2)-($b2+$t1);
            }
            
        return view('panel.Management.add_balance' , compact('moves_data_year','state','moves_data','user','data_e','types','moves','data_y','balances' ,'request', 'id'));
    }

    public function save_balance(Request $request ,$id)
    {

        $data = User::find($id);
        if($id && $data == null){
          return redirect()->back()->with('danger' , __('Error User Account Not Found'));
        }

        $validator = Validator::make($request->all() ,[
            'amount' => 'required|max:255',
            'date' => 'required',
            'currency' => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $balance = $request->all();
        $balance['for_id'] = $id;
        $balance['user_id'] = auth()->user()->id;

        $item = UsersBalance::create($balance);
        if($item){
            if($id){
            return redirect()->back()->with('success' , __('UpDated'));
            }
            return redirect()->back()->with('success' , __('Created'));
        }
      return redirect()->back()->with('danger' , __('Error User Account Not Created'));
    }

    public function balance_delete($id)
    {
        $item = UsersBalance::where("users_balance_id",$id)->first();
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'The deletion was successful') : $this->response_api(false, 'Error');
    }

}
