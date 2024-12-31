<?php

namespace App\Http\Controllers\Panel;
use Illuminate\Database\Eloquent\Builder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Income;
use App\Models\Movement;
use App\Models\MovementUser;
use App\Models\Countries;
use Validator;
use Carbon\Carbon;
use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\Debt;

class MovementController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function taxs(Request $request)
    {
        $thisYear = date("Y");
        $thisMonth = date("m");
        //\Artisan::call('ChangeDay:cron');

        $user_m = User::find(@$request->d_user);
        $user = auth()->user();
        $data = Movement::select("*" , \DB::raw("DATE_FORMAT(date, '%M %Y') new_date"), \DB::raw("DATE_FORMAT(date, '%Y') new_year"));
        $data = $data->where("tax","!=","0");
        if($user->type == "1"){
            $data = $data->wherehas("m_user" , function (Builder $query) use($user){
                $query->where("type" ,"!=", "5");
            });
        }else{
            $data = $data->wherehas("users" , function (Builder $query) use($user){
                $query->where("id" , $user->id);
            });
        }
        if(isset($request->d_user) && $request->d_user != null){
            if(@$user_m->type == "1"){
                $data = $data->where("user_id" , $request->d_user);
            }else{
                $data = $data->wherehas("users" , function (Builder $query) use($user , $request){
                    $query->where("id" , $request->d_user);
                });
            }
        }

        if($request->country_id != null){
            $data = $data->where("country_id" , $request->country_id);
        }
        if($request->m_type != null){
            $data = $data->where("type" , $request->m_type);
        }
        if($request->type != null){
            //$data = $data->where("u.type" , $request->type);
            $data = $data->wherehas("users" , function (Builder $query) use($user , $request){
                $query->where("users.type" , $request->type);
            });
        }



        if($request->from_date != null && $request->to_date == null){
            $data = $data->where("date" , $request->from_date);
        }
        if($request->from_date != null && $request->to_date != null){
            $data = $data->whereBetween("date" , [$request->from_date,$request->to_date]);
        }
        if($request->from_date == null && $request->to_date == null){
            $data = $data->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
        }
        
        $datas = $data->orderby("date" , "asc")->orderby("user_id" , "asc")->orderby("type" , "asc")->get();
        $data_year = $data->orderby("date" , "asc")->groupby("new_date")->get();
        $data = collect();
        foreach($data_year as $item){
            $items = collect();
            foreach($datas as $it){
                if($it->new_date == $item->new_date){
                    $it->sebder_user = isset($it->sender_user) && $it->sender_user != null ? 1 : null;
                    $items->push($it);
                }
            }
            $data->push([$item->new_date => $items]);
            //dd($items);
        }
        
        $request = $request->all();
        return view('panel.Movement.taxview' , compact('data','request'));
    }
    public function index(Request $request)
    {
        $thisYear = date("Y");
        $thisMonth = date("m");
        if(
                (Auth()->user()->type == 2  || Auth()->user()->type == 3 || Auth()->user()->type == 4 || Auth()->user()->type == 5 ) 
                 && $request->from_date == null
            ){
            return redirect('/admin/entries?d_user='.Auth()->user()->id.'&from_date='.$thisYear.'-'.$thisMonth.'-01&to_date='.$thisYear.'-'.$thisMonth.'-31');
        }
         \Artisan::call('ChangeDay:cron');

        //dd("ASsD");
        $user_m = User::find(@$request->d_user);
        $user = auth()->user();
        $maher_user = User::find(5);
        
        $ispartner = User::find($request->d_user);
        $depts_usd = 0;
        $depts_p = 0;
        $depts_e = 0;
        $depts_tl = 0;
        if(isset($ispartner) && $ispartner != null){
            $depts = Debt::where("for_id",$ispartner->id);
            $depts_usd = $depts->where("price_type", "$")->sum("price");
            $depts_p = $depts->where("price_type", "£")->sum("price");
            $depts_e = $depts->where("price_type", "€")->sum("price");
            $depts_tl = $depts->where("price_type", "TL")->sum("price");
        }

        $data_old = Movement::select("*" , \DB::raw("DATE_FORMAT(date, '%M %Y') new_date"), \DB::raw("DATE_FORMAT(date, '%Y') new_year"));
        if($user->type == "1"){
            $data_old = $data_old->wherehas("m_user" , function (Builder $query) use($user){
                $query->where("type" ,"!=", "5");
            });
        }else{
            $data_old = $data_old->wherehas("users" , function (Builder $query) use($user){
                $query->where("id" , $user->id);
            });
        }
        if(isset($request->d_user) && $request->d_user != null){
            if(@$user_m->type == "1"){
                $data_old = $data_old->where("user_id" , $request->d_user);
            }else{
                $data_old = $data_old->wherehas("users" , function (Builder $query) use($user , $request){
                    $query->where("id" , $request->d_user);
                });
            }
        }
        
        if($request->country_id != null){
            $data_old = $data_old->where("country_id" , $request->country_id);
        }
        if($request->m_type != null){
            $data_old = $data_old->where("type" , $request->m_type);
        }
        if($request->type != null){
                $data_old = $data_old->wherehas("users" , function (Builder $query) use($user , $request){
                    $query->where("users.type" , $request->type);
                });
        }
        if($request->showblue != null){
            $data_old = $data_old->where("color" , $request->showblue);
        }

        $fdate=null;
        $tdate=null;

        if($request->from_date != null && $request->to_date != null){
            $fdate=$request->from_date;
            $tdate=$request->to_date;
        }
        if($request->from_date == null && $request->to_date == null){
            $fdate=$thisYear."-".$thisMonth."-01";
            $tdate=$thisYear."-".$thisMonth."-31";
        }
        
        $data_old = $data_old->with("country","m_user","users","sender_user","notification","musers","sender_user");
        $data_old = $data_old->orderby("date" , "asc")->whereNotBetween("date", [$fdate,$tdate])->where("to_date",">",$fdate)->where("to_date","<",$tdate)->get();
        
        $data = Movement::select("movement.*" ,"movement_user.user_id as l_user_id", \DB::raw("DATE_FORMAT(date, '%M %Y') new_date"), \DB::raw("DATE_FORMAT(date, '%Y') new_year"));
        // $user->type="2";
        // $user->id="3";
        if($user->type == "1"){
            if(isset($ispartner) && $ispartner->type == 5){
                $data = $data->wherehas("m_user" , function (Builder $query) use($user){
                    $query->where("type" ,"!=", "5");
                }); 
            }
            
        }else{
            $data = $data->wherehas("users" , function (Builder $query) use($user){
                $query->where("id" , $user->id);
            });
            if($user->type == 5){
                $data = $data->wherehas("m_user" , function (Builder $query) use($user){
                    $query->where("type" ,"!=", "5");
                });
            }
        }
        if(isset($request->d_user) && $request->d_user != null){
            if(@$user_m->type == "1"){
                $data = $data->where(function ($query) use($request) {
                    $query->where('movement.user_id', '=', $request->d_user)
                          ->orWhere('movement.middleman', '=', 1);
                });
                //$data = $data->where("movement.user_id" , $request->d_user)->orwhere("movement.middleman" , "1");
            }else{
                $data = $data->wherehas("users" , function (Builder $query) use($user , $request){
                    $query->where("id" , $request->d_user);
                });
            }
        }

        if($request->showblue != null){
            $data = $data->where("color" , $request->showblue);
        }
        if($request->country_id != null){
            $data = $data->where("country_id" , $request->country_id);
        }
        if($request->m_type != null){
            $data = $data->where("movement.type" , $request->m_type);
        }
        if($request->type != null){
            //$data = $data->where("u.type" , $request->type);
            $data = $data->wherehas("users" , function (Builder $query) use($user , $request){
                $query->where("users.type" , $request->type);
            });
        }



        if($request->from_date != null && $request->to_date == null){
            $data = $data->where("date" , $request->from_date);
        }
        if($request->from_date != null && $request->to_date != null){
            $data = $data->whereBetween("date" , [$request->from_date,$request->to_date]);
        }
        if($request->from_date == null && $request->to_date == null){
            $data = $data->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
            // $request->st = "p";
        }
        // if($request->st == null){
        //     $request->st = "f";
        // }
        // if($request->st == "c"){
        //     $data = $data->where("completed",1);
        // }
        // if($request->st == "p" ){
        //     $data = $data->where("completed",0);
        // }
        // if($request->st == "f" ){
        //     $data = $data->wherein("completed",[1,0]);
        // }
        $data_forant = $data;


        $ahlandatas = collect();
        if(isset($ispartner)){
            $incs =  Income::where("for_id",$ispartner->id)->whereNull("movement_id");
            if(Auth()->user()->type == 1){
                if($request->from_date != null && $request->to_date == null){
                    $incs = $incs->where("date" , $request->from_date);
                }
                if($request->from_date != null && $request->to_date != null){
                    $incs = $incs->whereBetween("date" , [$request->from_date,$request->to_date]);
                }
                if($request->from_date == null && $request->to_date == null){
                    //$incs = $incs->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
                }
            }
            $incs = $incs->get();
            
            //dd($incs->where("price_type","TL"));
            try{
                $b1_usd = $incs->where("price_type","$")->where("type","Income")->sum("price");
                $b1_p = $incs->where("price_type","£")->where("type","Income")->sum("price");
                $b1_e = $incs->where("price_type","€")->where("type","Income")->sum("price");
                $b1_tl = $incs->where("price_type","TL")->where("type","Income")->sum("price");
                
                $b2_usd = $incs->where("price_type","$")->where("type","Expenses")->sum("price");
                $b2_p = $incs->where("price_type","£")->where("type","Expenses")->sum("price");
                $b2_e = $incs->where("price_type","€")->where("type","Expenses")->sum("price");
                $b2_tl = $incs->where("price_type","TL")->where("type","Expenses")->sum("price");
            }catch(\Exception $e){
                $b1_usd = 0;
                $b1_p = 0;
                $b1_e = 0;
                $b1_tl = 0;
                $b2_usd = 0;
                $b2_p = 0;
                $b2_e = 0;
                $b2_tl = 0;
            }
            //dd("TEst1");
            // Leader
            //dd("ASD");
            $moves =  Movement::wherehas("leader_user" , function (Builder $query) use($ispartner){
                $query->where("user_id" , $ispartner->id);
            })->orderby("movement_id");
            
            if(Auth()->user()->type == 1){
                if($request->from_date != null && $request->to_date == null){
                    $moves = $moves->where("date" , $request->from_date);
                }
                if($request->from_date != null && $request->to_date != null){
                    $moves = $moves->whereBetween("date" , [$request->from_date,$request->to_date])->where("leader_paid","0");
                }
                if($request->from_date == null && $request->to_date == null){
                    //$moves = $moves->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
                }
            }
            
            $movess = $moves->get();
            //dd($movess->where("price_type","$")->where("paybyus" , "0")->toarray());
            //dd($movess->where("price_type","$")->where("paybyus" , "0"));
            $m_usd = $movess->where("price_type","$")->where("paybyus" , "0")->sum("admin_partner")
                        + $movess->where("admin_commission_type","$")->where("paybyus" , "0")->sum("admin_commission")
                        + $movess->where("commission_type","$")->where("paybyus" , "0")->sum("commission")
                        + $movess->where("price_type","$")->where("paybyus" , "0")->sum("revenue_partner")
                        + $movess->where("price_type","$")->where("paybyus" , "0")->sum("revenue")
                        + $movess->where("price_type","$")->where("paybyus" , "0")->where("t_paid",1)->sum("t_net");
                        
            //     dd($m_usd,$movess->where("price_type","$")->where("paybyus" , "0")->where("t_paid",1)->sum("t_net"));       
            $m_p = $movess->where("price_type","£")->where("paybyus" , "0")->sum("admin_partner")
                        + $movess->where("admin_commission_type","£")->where("paybyus" , "0")->sum("admin_commission")
                        + $movess->where("commission_type","£")->where("paybyus" , "0")->sum("commission")
                        + $movess->where("price_type","£")->where("paybyus" , "0")->sum("revenue_partner")
                        + $movess->where("price_type","£")->where("paybyus" , "0")->sum("revenue")
                        + $movess->where("price_type","£")->where("paybyus" , "0")->where("t_paid",1)->sum("t_net");
                        
            $m_e = $movess->where("price_type","€")->where("paybyus" , "0")->sum("admin_partner")
                        + $movess->where("admin_commission_type","€")->where("paybyus" , "0")->sum("admin_commission")
                        + $movess->where("commission_type","€")->where("paybyus" , "0")->sum("commission")
                        + $movess->where("price_type","€")->where("paybyus" , "0")->sum("revenue_partner")
                        + $movess->where("price_type","€")->where("paybyus" , "0")->sum("revenue")
                        + $movess->where("price_type","€")->where("paybyus" , "0")->where("t_paid",1)->sum("t_net");
                        
            $m_tl = $movess->where("price_type","TL")->where("paybyus" , "0")->sum("admin_partner")
                        + $movess->where("admin_commission_type","TL")->where("paybyus" , "0")->sum("admin_commission")
                        + $movess->where("commission_type","TL")->where("paybyus" , "0")->sum("commission")
                        + $movess->where("price_type","TL")->where("paybyus" , "0")->sum("revenue_partner")
                        + $movess->where("price_type","TL")->where("paybyus" , "0")->sum("revenue")
                        + $movess->where("price_type","TL")->where("paybyus" , "0")->where("t_paid",1)->sum("t_net");
            //dd($m_usd,$m_p,$m_e,$m_tl);            
            // Sum Paid By US
            $bm_usd = $movess->where("price_type","$")->where("paybyus" , "1")->sum("net");
                        
            $bm_p = $movess->where("price_type","£")->where("paybyus" , "1")->sum("net");
                        
            $bm_e = $movess->where("price_type","€")->where("paybyus" , "1")->sum("net");
                        
            $bm_tl = $movess->where("price_type","TL")->where("paybyus" , "1")->sum("net");
            //dd($m_usd,$m_p,$m_e,$m_tl,$bm_usd,$bm_p,$bm_e,$bm_tl);
            // Sender
            $smoves =  Movement::wherehas("sender_user" , function (Builder $query) use($ispartner){
                $query->where("user_id" , $ispartner->id);
            });
            
            if(Auth()->user()->type == 1){
                if($request->from_date != null && $request->to_date == null){
                    $smoves = $smoves->where("date" , $request->from_date);
                }
                if($request->from_date != null && $request->to_date != null){
                    $smoves = $smoves->whereBetween("date" , [$request->from_date,$request->to_date])->where("sender_paid","0");
                }
                if($request->from_date == null && $request->to_date == null){
                    //$smoves = $smoves->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
                }
            }
            
            $smoves = $smoves->get();
            
            //dd($smoves);
            
            // // Sum Profit Sender
            $pm_usd = $smoves->where("price_type","$")->sum("revenue_partner");
                        
            $pm_p = $smoves->where("price_type","£")->sum("revenue_partner");
                        
            $pm_e = $smoves->where("price_type","€")->sum("revenue_partner");
                        
            $pm_tl = $smoves->where("price_type","TL")->sum("revenue_partner");
                        
            // Sum Paid By US 
            $sbm_usd = $smoves->where("price_type","$")->where("paybyus" , "1")->sum("price");
                        // + $smoves->where("admin_commission_type","$")->where("paybyus" , "1")->sum("admin_commission")
                        // + $smoves->where("commission_type","$")->where("paybyus" , "1")->sum("commission");
                        
            $sbm_p = $smoves->where("price_type","£")->where("paybyus" , "1")->sum("price");
                        // + $smoves->where("admin_commission_type","£")->where("paybyus" , "1")->sum("admin_commission")
                        // + $smoves->where("commission_type","£")->where("paybyus" , "1")->sum("commission");
                        
            $sbm_e = $smoves->where("price_type","€")->where("paybyus" , "1")->sum("price");
                        // + $smoves->where("admin_commission_type","€")->where("paybyus" , "1")->sum("admin_commission")
                        // + $smoves->where("commission_type","€")->where("paybyus" , "1")->sum("commission");
                        
            $sbm_tl = $smoves->where("price_type","TL")->where("paybyus" , "1")->sum("price");
                        // + $smoves->where("admin_commission_type","TL")->where("paybyus" , "1")->sum("admin_commission")
                        // + $smoves->where("commission_type","TL")->where("paybyus" , "1")->sum("commission");
              
                        
            //dd($b1_usd,$pm_usd,$b2_usd,$m_usd,$sbm_usd,$bm_usd);
            //dd($b1_tl,$pm_tl,$b2_tl,$m_tl,$sbm_tl,$bm_tl);
            //dd($b1_tl,$m_tl,$bm_tl,$sbm_tl,$b2_tl,$pm_tl);
            //dd((($b1_usd + $pm_usd)-$b2_usd),(($m_usd+$sbm_usd)-$bm_usd));
            $ispartner->s_usd = (($b1_usd + $pm_usd)-$b2_usd)-(($m_usd+$sbm_usd)-$bm_usd);
            $ispartner->s_p = (($b1_p + $pm_p)-$b2_p)-(($m_p+$sbm_p)-$bm_p);
            $ispartner->s_e = (($b1_e + $pm_e)-$b2_e)-(($m_e+$sbm_e)-$bm_e);
            $ispartner->s_tl = (($b1_tl + $pm_tl)-$b2_tl)-(($m_tl+$sbm_tl)-$bm_tl);
            // $ispartner->s_p = ($b1_p-$sbm_p) - ($m_p-$bm_p) - $b2_p - $pm_p;
            // $ispartner->s_e = ($b1_e-$sbm_e) - ($m_e-$bm_e) - $b2_e - $pm_e;
            // $ispartner->s_tl = ($b1_tl-$sbm_tl) - ($m_tl-$bm_tl) - $b2_tl - $pm_tl;
            
            
        }
        if(isset($ispartner) && $ispartner->type == 5){
            $moves1 =  Movement::where("user_id",$ispartner->id)->where("status",0)->get();
            
            $moves2 =  Movement::where("status",0)
                                ->wherehas("leader_user" , function (Builder $query) use($ispartner){
                                    $query->where("user_id" , $ispartner->id);
                                })->get();

            $t1 = $moves1;
            $t2 = $moves2;

            $t10 = 0;
            $t20 = 0;
            $t30 = 0;
            
            $t10 = $moves2->where("price_type","$")->where("paybyus" , "0")->sum("revenue")
                + $moves2->where("price_type","$")->where("paybyus" , "0")->sum("admin_partner")
                + $moves2->where("commission_type","$")->sum("commission")
                + $moves2->where("admin_commission_type","$")->sum("admin_commission");
            
            $t20 = $moves1->where("price_type","$")->where("paybyus" , "1")->sum("price");
                
            $t30 = $moves1->where("price_type","$")->sum("revenue_partner");


            $ispartner->blance_usd =  ($t20 + $t10) - $t30;


            $t10 = 0;
            $t20 = 0;

            $t10 = $moves2->where("price_type","£")->where("paybyus" , "0")->sum("revenue")
                    + $moves2->where("price_type","£")->where("paybyus" , "0")->sum("admin_partner")
                    - $moves2->where("price_type","£")->where("paybyus" , "1")->sum("net");

            $t20 = $moves1->where("price_type","£")->where("paybyus" , "1")->sum("net")
                    + $moves1->where("price_type","£")->where("paybyus" , "1")->sum("revenue")
                    - $moves1->where("price_type","£")->where("paybyus" , "0")->sum("revenue_partner");

            $ispartner->blance_p = $t20 + $t10;

            $t10 = 0;
            $t20 = 0;

            $t10 = $moves2->where("price_type","€")->where("paybyus" , "0")->sum("revenue")
                    + $moves2->where("price_type","€")->where("paybyus" , "0")->sum("admin_partner")
                    - $moves2->where("price_type","€")->where("paybyus" , "1")->sum("net");

            $t20 = $moves1->where("price_type","€")->where("paybyus" , "1")->sum("net")
                    + $moves1->where("price_type","€")->where("paybyus" , "1")->sum("revenue")
                    - $moves1->where("price_type","€")->where("paybyus" , "0")->sum("revenue_partner");

            $ispartner->blance_e = $t20 + $t10;

            $t10 = 0;
            $t20 = 0;

            $t10 = $moves2->where("price_type","TL")->where("paybyus" , "0")->sum("revenue")
                    + $moves2->where("price_type","TL")->where("paybyus" , "0")->sum("admin_partner")
                    - $moves2->where("price_type","TL")->where("paybyus" , "1")->sum("net");

            $t20 = $moves1->where("price_type","TL")->where("paybyus" , "1")->sum("net")
                    + $moves1->where("price_type","TL")->where("paybyus" , "1")->sum("revenue")
                    - $moves1->where("price_type","TL")->where("paybyus" , "0")->sum("revenue_partner");

            $ispartner->blance_tl = $t20 + $t10;
        }
        // if(isset($ispartner) && $ispartner->type == 3){
        //     $incs =  Income::where("for_id",$ispartner->id)->where("price_type","$")->whereNull("movement_id")->get();
        //     $b1 = 0;
        //     $b2 = 0;
        //     foreach($incs as $inc){
        //         if($inc->movement_id == null && $inc->type == "Income"){
        //             $b1 += $inc->price;
        //         }else{
        //             $b1 -= $inc->price;
        //         }
        //     }
            
        //     $moves =  Movement::wherehas("users" , function (Builder $query) use($ispartner){
        //         $query->where("id" , $ispartner->id);
        //     })
        //     ->where("price_type" , "$");
        //     $t10 = $moves;
        //     $t20 = $moves;
        //     $t2 = $t20->sum("revenue_partner");
            
            
        //     // if($moves->count() == 0){
        //     //     $movesw =  Movement::wherehas("users" , function (Builder $query) use($ispartner){
        //     //         $query->where("id" , $ispartner->id);
        //     //     })
        //     //     ->where("status","1")
        //     //     ->where("price_type" , "$")->sum("revenue_partner");
        //     //     $t2 = $t2 - $movesw;
        //     // }
                
                
        //     //$t3 = $t20->where("sender_paid","1")->sum("revenue_partner");
        //     //$t2 = $t2 - $t3;
        //     $t1 = $t10->where("paybyus" , "1")->sum("price");
            
        //     $ispartner->blance = ($b1+$t2)-($b2+$t1);
        // }
        if(isset($ispartner) && $ispartner->id == 5){
            
            $moves1 =  Movement::where("status","1")->get();
            $ispartner->blance_usd = $moves1->where("price_type","$")->sum("admin_partner")
                                    + $moves1->where("admin_commission_type","$")->sum("admin_commission");
            $ispartner->blance_p = $moves1->where("price_type","£")->sum("admin_partner")
                                    + $moves1->where("admin_commission_type","£")->sum("admin_commission");
            $ispartner->blance_e = $moves1->where("price_type","€")->sum("admin_partner")
                                    + $moves1->where("admin_commission_type","€")->sum("admin_commission");
            $ispartner->blance_tl = $moves1->where("price_type","TL")->sum("admin_partner")
                                    + $moves1->where("admin_commission_type","TL")->sum("admin_commission");
            
        }
        if(isset($ispartner) && $ispartner->id == 25){
            $moves =  Movement::wherehas("users" , function (Builder $query) use($ispartner){
                $query->where("id" , $ispartner->id);
            });
            
            if($request->from_date != null && $request->to_date == null){
                $moves = $moves->where("date" , $request->from_date);
            }
            if($request->from_date != null && $request->to_date != null){
                $moves = $moves->whereBetween("date" , [$request->from_date,$request->to_date]);
            }
            if($request->from_date == null && $request->to_date == null){
                $moves = $moves->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
            }
            $moves = $moves->where("leader_paid",0)->where("status","0")->get();
            $movess = $moves;
            $movess2 = $moves;
            
            $dnet = $movess->where('price_type', "TL")->where("paybyus" , "0")->where("net_tl",0)->sum("net") + $movess->where("paybyus" , "0")->sum("net_tl");
            $pnet = $moves->where('price_type', "TL")->where("paybyus" , "1")->where("net_tl",0)->sum("net") + $moves->where("paybyus" , "1")->sum("net_tl");
            $rprices = $movess2->where('price_type', "TL")->where("paybyus" , "0")->sum("price");
           
            $ispartner->blance_tlgn = ($rprices - ($dnet+$pnet));
        }
        if(isset($ispartner) && ($ispartner->id == 27 || $ispartner->id == 34) ){
            $moves1 =  Movement::wherehas("users" , function (Builder $query) use($ispartner){
                $query->where("id" , $ispartner->id);
            })->get();
            
            $moves2 =  Movement::wherehas("users" , function (Builder $query) use($ispartner){
                $query->where("id" , $ispartner->id);
            })->where("user_id","5")->get();
            
            
            $ispartner->blance_usd = $moves1->where("price_type","$")->sum("revenue")
                                    + $moves1->where("commission_type","$")->sum("commission");
                                    
            $ispartner->blance_p = $moves1->where("price_type","£")->sum("revenue")
                                    + $moves1->where("commission_type","£")->sum("commission");
            $ispartner->blance_e = $moves1->where("price_type","€")->sum("revenue")
                                    + $moves1->where("commission_type","€")->sum("commission");
            $ispartner->blance_tl = $moves1->where("price_type","TL")->sum("revenue")
                                    + $moves1->where("commission_type","TL")->sum("commission");
                                    
            $ispartner->Mblance_usd = $moves2->where("price_type","$")->sum("admin_partner")
                                    + $moves2->where("admin_commission_type","$")->sum("admin_commission");
            $ispartner->Mblance_p = $moves2->where("price_type","£")->sum("admin_partner")
                                    + $moves2->where("admin_commission_type","£")->sum("admin_commission");
            $ispartner->Mblance_e = $moves2->where("price_type","€")->sum("admin_partner")
                                    + $moves2->where("admin_commission_type","€")->sum("admin_commission");
            $ispartner->Mblance_tl = $moves2->where("price_type","TL")->sum("admin_partner")
                                    + $moves2->where("admin_commission_type","TL")->sum("admin_commission");
                                    
        }
        
        //->orderby("user_id" , "asc")
        $data = $data->leftJoin('movement_user', 'movement_user.movement_id', '=', 'movement.movement_id')->where("movement_user.type","0");
        $data = $data->with("country","m_user","users","sender_user","notification","musers","sender_user");
        $ndata = $data;
        $datas = $data->orderby("date" , "asc")->orderby("l_user_id" , "asc")->orderby("type" , "asc")->get();
        $data_year = $ndata->orderby("date" , "asc")->groupby("new_date")->get();

        if(isset($request->d_user) && $request->d_user != null){

            if($ispartner != null && $ispartner->type == 5){
                $ahlandata = Movement::select("*" , \DB::raw("DATE_FORMAT(date, '%M %Y') new_date"), \DB::raw("DATE_FORMAT(date, '%Y') new_year"));
                $ahlandata = $ahlandata->where("user_id" , $ispartner->id);
                
                $data_yearw = Movement::select("*" , \DB::raw("DATE_FORMAT(date, '%M %Y') new_date"), \DB::raw("DATE_FORMAT(date, '%Y') new_year"))
                                ->orderby("date" , "asc");
                //dd($data_year);
                // $ahlandata = $ahlandata->wherehas("users" , function (Builder $query) use($user){
                //     $query->where("id" , 19);
                // });
                
                
                
                if($request->country_id != null){
                    $ahlandata = $ahlandata->where("country_id" , $request->country_id);
                    $data_yearw = $data_yearw->where("country_id" , $request->country_id);
                }
                if($request->m_type != null){
                    $ahlandata = $ahlandata->where("type" , $request->m_type);
                    $data_yearw = $data_yearw->where("type" , $request->m_type);
                }
                if($request->type != null){
                    $ahlandata = $ahlandata->wherehas("users" , function (Builder $query) use($user , $request){
                        $query->where("users.type" , $request->type);
                    });
                    $data_yearw = $data_yearw->wherehas("users" , function (Builder $query) use($user , $request){
                        $query->where("users.type" , $request->type);
                    });
                }
                if($request->from_date != null && $request->to_date == null){
                    $ahlandata = $ahlandata->where("date" , $request->from_date);
                    $data_yearw = $data_yearw->where("date" , $request->from_date);
                }
                if($request->from_date != null && $request->to_date != null){
                    $ahlandata = $ahlandata->whereBetween("date" , [$request->from_date,$request->to_date]);
                    $data_yearw = $data_yearw->whereBetween("date" , [$request->from_date,$request->to_date]);
                }
                if($request->from_date == null && $request->to_date == null){
                    $ahlandata = $ahlandata->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
                    $data_yearw = $data_yearw->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
                }
                
                $ahlandata = $ahlandata->orderby("date" , "asc")->get();
                $data_years = $data_yearw->groupby("new_date")->get();
                //dd($data_year);
                $ahlandatas = collect();
                foreach($data_years as $item){
                    $items = collect();
                    foreach($ahlandata as $it){
                        if($it->new_date == $item->new_date){
                            //var_dump($item->new_date);
                            $items->push($it);
                        }
                    }
                    $ahlandatas->push([$item->new_date => $items]);
                    //dd($items);
                }
            }
        }
        //dd($data->get());


        $types = collect();
        $types->push("Driver Tours" ,"Group Tours","Flights" ,"Transfers" , "hotels" ,"Other Services");
        $data = collect();
        
        foreach($data_year as $item){
            $items = collect();
            foreach($datas as $it){
                if($it->new_date == $item->new_date){
                    $it->sebder_user = isset($it->sender_user) && $it->sender_user != null ? 1 : null;
                    $items->push($it);
                }
            }
            $data->push([$item->new_date => $items]);
            //dd($items);
        }
        
        $users = User::get();
        $countries = Countries::get();
        $OldCount = Movement::query();

        if($request->from_date != null && $request->to_date == null){
            $OldCount = $OldCount->whereYear("date" , $thisYear)->where("date" ,"<", $request->from_date);
        }
        if($request->from_date != null && $request->to_date != null){
            $OldCount = $OldCount->whereYear("date" , $thisYear)->where("date" ,"<", $request->from_date);
        }
        if($request->from_date == null && $request->to_date == null){
            $OldCount = $OldCount->whereYear("date" , $thisYear)->whereMonth("date","<",$thisMonth);
        }
        if(isset($request->d_user) && $request->d_user != null){
            if(@$user_m->type == "1"){
                $OldCount = $OldCount->where("user_id" , $request->d_user);
            }else{
                $OldCount = $OldCount->wherehas("users" , function (Builder $query) use($user , $request){
                    $query->where("id" , $request->d_user);
                });
            }
        }
        $OldCount = $OldCount->count();
        //dd($datas->where("status",1)->map->only(['revenue',"movement_id"]));
        $NowCount = Movement::query();
        if($request->from_date != null && $request->to_date == null){
            $NowCount = $NowCount->where("date" , $request->from_date);
        }
        if($request->from_date != null && $request->to_date != null){
            $NowCount = $NowCount->whereBetween("date" , [$request->from_date,$request->to_date]);
        }
        if($request->from_date == null && $request->to_date == null){
            $NowCount = $NowCount->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
        }

        if(isset($request->d_user) && $request->d_user != null){
            if(@$user_m->type == "1"){
                $NowCount = $NowCount->where("user_id" , $request->d_user);
            }else{
                $NowCount = $NowCount->wherehas("users" , function (Builder $query) use($user , $request){
                    $query->where("id" , $request->d_user);
                })->where("user_id" , "!=",$request->d_user);
            }
        }

        $NowCount = $NowCount->count();
        
        $NowCount2 = Movement::query();
        if($request->from_date != null && $request->to_date == null){
            $NowCount2 = $NowCount2->where("date" , $request->from_date);
        }
        if($request->from_date != null && $request->to_date != null){
            $NowCount2 = $NowCount2->whereBetween("date" , [$request->from_date,$request->to_date]);
        }
        if($request->from_date == null && $request->to_date == null){
            $NowCount2 = $NowCount2->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
        }

        if(isset($request->d_user) && $request->d_user != null){
            if(@$user_m->type == "1"){
                $NowCount2 = $NowCount2->where("user_id" , $request->d_user);
            }else{
                if(@$user_m->type == "5"){
                    $NowCount2 = $NowCount2->wherehas("m_user" , function (Builder $query) use($user , $request){
                        $query->where("id" , $request->d_user);
                    });
                }
            }
        }

        $NowCount2 = $NowCount2->count();
        

        $data_income = Income::
            select(
                "*",
                \DB::raw("DATE_FORMAT(date, '%M %Y') new_date")
            );
        if(Auth()->user()->type == 1){
            if($request->from_date != null && $request->to_date == null){
                $data_income = $data_income->where("date" , $request->from_date);
            }
            if($request->from_date != null && $request->to_date != null){
                $data_income = $data_income->whereBetween("date" , [$request->from_date,$request->to_date]);
            }
    
            if($request->from_date == null && $request->to_date == null){
                $data_income = $data_income->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
            }
        }
        
        $data_income = $data_income->orderby("new_date" , "DESC");
        $data_e = $data_income->where("for_id" , $request->d_user)->get();
        //dd($data_e);
        $data_y = $data_income->where("for_id" , $request->d_user)->groupby("new_date")->get();
        

        $moves_a =  Movement::select("*",\DB::raw("DATE_FORMAT(date, '%M %Y') new_date"));

        if($request->from_date != null && $request->to_date == null){
            $moves_a = $moves_a->where("date" , $request->from_date);
        }
        if($request->from_date != null && $request->to_date != null){
            $moves_a = $moves_a->whereBetween("date" , [$request->from_date,$request->to_date]);
        }

        if($request->from_date == null && $request->to_date == null){
            $moves_a = $moves_a->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
        }

        if(isset($request->d_user) && $request->d_user != null){
            if(@$user_m->type == "1"){
                $moves_a = $moves_a->where("user_id" , $request->d_user);
            }else{
                $moves_a = $moves_a->wherehas("users" , function (Builder $query) use($user , $request){
                    $query->where("id" , $request->d_user);
                });
            }
        }

        
        $moves_dataJust = $moves_a->where("user_id" , $request->d_user)->orderby("date" , "asc")->get();
        $moves_data = $moves_a->orderby("date" , "asc")->get();
        $moves_data_year = $moves_a->groupby("new_date")->get();
        $cur_today = Carbon::now()->addHour(4)->format("Y-m-d");
        $data_today = Movement::select("type", \DB::raw('count(*) as total'));
        $data_today = $data_today->where("date" , $cur_today);
        $data_today = $data_today->with("m_user");
        $data_today = $data_today->groupby("type")->get();
        
        foreach($data_today as $tda){
           $rows =  Movement::select("type", "user_id", \DB::raw('count(*) as total'))->where("type" , $tda->type)->where("date" , $cur_today)->groupby("user_id")->get();
           $tda->users = $rows;
        }
        $sts = $data_today->first();
        
        
        //dd($sts->users->first()->m_user);
        $request = $request->all();
        if(@$request['from_date'] == null && @$request['to_date'] == null && @$request["st"] == null){
            $request["st"] = "p";
        }
        if(@$request["st"] == null){
            $request["st"] = "f";
        }
        if(@$request["d_user"] != null || (@$request['from_date'] != null || @$request['to_date'] != null)){
            $request["st"] = "f";
        }
        return view('panel.Movement.view' , compact("maher_user","moves_dataJust","datas","cur_today","data_today","depts_usd","depts_p","depts_e","depts_tl",'moves_data_year',"data_old",'moves_data','data_y','data_e','data','user_m','ispartner','NowCount','NowCount2','OldCount','ahlandatas','users','countries','request' ,"types"));
    }


    public function paid(Request $request)
    {

        $thisYear = date("Y");
        $thisMonth = date("m");
        \Artisan::call('ChangeDay:cron');

        $user_d = User::find(@$request->d_user);
        
        // if($user_d->type != 2){
        //     return redirect()->back()->with('danger' , __('Sorry This Not Driver'));
        // }

        $data = Movement::select("*" , \DB::raw("DATE_FORMAT(date, '%M %Y') new_date"), \DB::raw("DATE_FORMAT(date, '%Y') new_year"));

        if(isset($request->d_user) && $request->d_user != null){
            $data = $data->wherehas("users" , function (Builder $query) use($request){
                $query->where("id" , $request->d_user);
            });
        }
        //if($user_d->type == 2){
            if($request->country_id != null){
                $data = $data->where("country_id" , $request->country_id);
            }
            if($request->m_type != null){
                $data = $data->where("type" , $request->m_type);
            }
            if($request->type != null){
                $data = $data->wherehas("users" , function (Builder $query) use( $request){
                    $query->where("users.type" , $request->type);
                });
            }
            if($request->from_date != null && $request->to_date == null){
                $data = $data->where("date" , $request->from_date);
            }
            if($request->from_date != null && $request->to_date != null){
                $data = $data->whereBetween("date" , [$request->from_date,$request->to_date]);
            }
            if($request->from_date == null && $request->to_date == null){
                $data = $data->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
            }
        //}
        $data_year = $data->where("status","0")->orderby("date" , "asc")->get();
        //dd($data_year);
        foreach($data_year as $item){
            if($item->paybyus == 0){
                if($item->leader_user->user_id == $user_d->id){
                    $item->leader_paid = 1;
                }elseif(isset($item->sender_user) && $item->sender_user != null && $item->sender_user->user_id == $user_d->id){
                    $item->sender_paid = 1;
                }
                if($item->sender_user == null){
                    $item->sender_paid = 1;
                }
            }
            elseif($item->paybyus == 1){
                if(isset($item->sender_user) && $item->sender_user != null && $item->sender_user->user_id == $user_d->id){
                    $item->sender_paid = 1;
                }
                elseif($item->leader_user->user_id == $user_d->id){
                    $item->leader_paid = 1;
                }
                if($item->sender_user == null){
                    $item->sender_paid = 1;
                }
            }
            
            if($item->leader_paid == 1 && $item->sender_paid == 1){
                $item->status = 1;
            }
            $item->save();
        }

        return redirect()->back()->with('success' , __('Success'));
    }

    public function change_status($id)
    {
        $partners = Movement::find($id);
        if($id != false && $partners == null){
          return redirect()->back()->with('danger' , __('Error Not Found'));
        }else{
          $partners->completed = $partners->completed == 1 ? '0' : '1';
            if($partners->completed == 1){
                $partners->color = 3;
            }else{
                $partners->color = 1;
            }
          if($partners->save()){
            return redirect()->back()->with('success' , __('Success '));
          }else{
            return redirect()->back()->with('danger' , __('Error Not Change'));
          }
        }
        return redirect()->back()->with('danger' , __('Error  Not Found'));
    }
    
    public function change_statusr($id)
    {
        $partners = Movement::find($id);
        if($id != false && $partners == null){
          return redirect()->back()->with('danger' , __('Error Not Found'));
        }else{
          $partners->color = 4;
          if($partners->save()){
            return redirect()->back()->with('success' , __('Success '));
          }else{
            return redirect()->back()->with('danger' , __('Error Not Change'));
          }
        }
        return redirect()->back()->with('danger' , __('Error  Not Found'));
    }

    public function delete($id)
    {
        $item = Movement::find($id);
        return (isset($item) && $item->delete()) ? $this->response_api(true, 'The deletion was successful') : $this->response_api(false, 'Error');
    }

    public function add_new($id = false)
    {
        $showDemoNotification = false;
        $showSuccesNotification  = false;
        $data = Movement::find($id);
        if($id != false && $data == null){
          return redirect()->back()->with('danger' , __('Error User Account Not Found'));
        }
        

        $users = User::where('type' , "!=","1")->get();
        $nusers = User::get();

        $countries = Countries::get();
        return view('panel.Movement.add_new' , compact('data','countries' ,'nusers','users', 'id' ,'showDemoNotification' ,'showSuccesNotification'));
    }

    public function save_new(Request $request ,$id = false)
    {
      if($id){
        $validator = Validator::make($request->all() ,[
            'customer' => 'required|max:255',
            'date' => 'required',
            'description' => 'required|max:255',
            'price' => 'required',
            'price_type' => 'required',
            'type' => 'required',
            'country_id' => 'required',
            //'status' => 'required',
        ]);
      }else{
        $validator = Validator::make($request->all() ,[
            'customer' => 'required|max:255',
            'date' => 'required',
            'description' => 'required|max:255',
            'price' => 'required',
            'price_type' => 'required',
            'type' => 'required',
            'country_id' => 'required',
            //'commission_type' => 'required',
            //'status' => 'required',
        ]);
      }

    if ($validator->fails()){
        return redirect()->back()->withInput()->withErrors($validator);
    }

      if($request->ntext != null || $request->to_user_id != null){
        $validator = Validator::make($request->all() ,[
            'ntext' => 'required|max:255',
            'to_user_id' => 'required',
        ]);
      }

      if ($validator->fails()){
          return redirect()->back()->withInput()->withErrors($validator);
      }


      if($id){
        $item = Movement::find($id);
      }else{
        $item = new Movement;
      }
      
      $item->customer = $request->customer;
      $item->date = $request->date;
      $item->to_date = $request->to_date;
      $item->time = @$request->time == null ? "" : $request->time;
      $item->to_time = @$request->to_time == null ? "" : $request->to_time;
      $item->description = $request->description;
      $item->price = $request->price;
      $item->price_type = $request->price_type;
      $item->sec_price = $request->sec_price;
      $item->sec_price_type = $request->sec_price_type;
      $item->hotel = $request->hotel == null ? "" : $request->hotel;
      $item->net = $request->net == null ? "0" : $request->net;
      $item->net_tl = $request->net_tl == null ? "0" : $request->net_tl;
      $item->revenue = $request->revenue == null ? "0" : $request->revenue;
      $item->revenue_partner = @$request->revenue_partner == null ? null : @$request->revenue_partner;
      $item->commission = $request->commission == null ? "0" : $request->commission;
      $item->commission_type = $request->commission_type == null ? null : $request->commission_type;
      $item->admin_commission = $request->admin_commission == null ? "0" : $request->admin_commission;
      $item->admin_commission_type = $request->admin_commission_type == null ? null : $request->admin_commission_type;
      $item->type = $request->type;
      $item->tax = $request->tax == null ? "0" : $request->tax;
      $item->paybyus = $request->paybyus == null ? "0" : $request->paybyus;
      $item->sender_paid = $request->sender_paid == null ? "0" : $request->sender_paid;
      $item->leader_paid = $request->leader_paid == null ? "0" : $request->leader_paid;
      $item->color = $request->completed == 1 ? "3" : $item->color;
      $item->country_id = $request->country_id;
      $item->status = $request->status == null ? "0" : $request->status;
      $item->commit = $request->commit == null ? "0" : $request->commit;
      $item->t_net = $request->t_net == null ? "0" : $request->t_net;
      $item->t_profit = $request->t_profit == null ? "0" : $request->t_profit;
      $item->t_paid = $request->t_paid == null ? "0" : $request->t_paid;
      $item->middleman = $request->middleman == null ? null : $request->middleman;
      if(!$id){
        $item->completed = $request->completed == null ? "0" : $request->completed;
      }
        $item->user_id = $request->user_id == null ?  auth()->user()->id : $request->user_id ;
        $item->admin_partner = $request->admin_partner == null ? null : $request->admin_partner;

      //}
        
        if(auth()->user()->id == 5){
            $item->middleman = 1;
        }
        
      
      if($request->l_users == null ){
        return redirect()->back()->withInput($request->input())->with('danger' , __('ERROR CAN NOT BE SAVED.  Leader Empty'));
      }
      
      
      if($item->paybyus == 1 && $item->revenue_partner != null ){
        return redirect()->back()->withInput($request->input())->with('danger' , __('ERROR CAN NOT BE SAVED. PAID BY US AND PARTNER PROFIT'));
      }
      if($item->admin_commission == 0 && $item->admin_commission_type != null ){
        return redirect()->back()->withInput($request->input())->with('danger' , __('Error Cant Save Admin commission '));
      }
      if($item->admin_commission != 0 && $item->admin_commission_type == null ){
        return redirect()->back()->withInput($request->input())->with('danger' , __('Error Cant Save Admin commission Type '));
      }
      
      if($item->commission == 0 && $item->commission_type != null ){
        return redirect()->back()->withInput($request->input())->with('danger' , __('Error Cant Save commission '));
      }
      if($item->commission != 0 && $item->commission_type == null ){
        return redirect()->back()->withInput($request->input())->with('danger' , __('Error Cant Save commission Type '));
      }
      
      if($item->sec_price == null && $item->sec_price_type != null ){
        return redirect()->back()->withInput($request->input())->with('danger' , __('Error Cant Save Sec Price '));
      }
      if($item->sec_price != null && $item->sec_price_type == null ){
        return redirect()->back()->withInput($request->input())->with('danger' , __('Error Cant Save Sec Price Type'));
      }
      if($item->status == "1" && ($item->sender_paid != 1 && $item->leader_paid != 1)){
        return redirect()->back()->withInput($request->input())->with('danger' , __('Error Cant Change Total Completed When Sender Or Leader Not Finish '));
      }
      
        if($id && $item->paybyus == 1 && $item->sender_user == null){
            $item->sender_paid = 1;
        }
        
      //dd($item);
                
      $item->save();

      if($item){
          if($item->status == 0){
              Income::where("movement_id",$id)->delete();
          }
        // if($item->status == 1 && $item->paybyus == 1){
        //     $income = Income::where("movement_id",$id)->where("type" , "Expenses")->first();
        //     if(!$income){
        //         $income = new Income;
        //     }
        //     if($item->net_tl != 0){
        //     $income->price = $item->net_tl;
        //     $income->price_type = "TL";
        //     }else{
        //     $income->price = $item->net;
        //     $income->price_type = $item->price_type;
        //     }
        //     $income->date = $item->date;
        //     $income->note = $item->customer;
        //     $income->for_id = $item->users->wherein("type" , [2,4,5])->first()->id;
        //     $income->type = "Expenses";
        //     $income->status = $item->status;
        //     $income->user_id = $item->user_id;
        //     $income->movement_id = $item->movement_id;
        //     $income->note = $item->customer;
        //     $income->save();

        //     $income = Income::where("movement_id",$id)->where("com", "0")->where("type" , "Income")->first();
        //     if(!$income){
        //         $income = new Income;
        //     }
        //     if($item->price_type == $item->commission_type ){
        //         $income->price = $item->price + $item->commission;
        //     }else{
        //         $income->price = $item->price;
        //     }
        //     $user_id = null;
        //     if(isset($item->users->wherein("type" , [3,5])->first()->id)){
        //         $user_id = $item->users->wherein("type" , [3,5])->first()->id;
        //     }else{
        //         $user_id = $item->users->first()->id;
        //     }
        //     $income->price_type = $item->price_type;
        //     $income->date = $item->date;
        //     $income->note = $item->customer;
        //     $income->for_id = $user_id;
        //     $income->type = "Income";
        //     $income->status = $item->status;
        //     $income->user_id = $item->user_id;
        //     $income->movement_id = $item->movement_id;
        //     $income->note = $item->customer;
        //     $income->save();

        //     if($item->price_type != $item->commission_type && $item->commission != 0){
        //         $income = Income::where("movement_id",$id)->where("com", "1")->where("type" , "Income")->first();
        //         if(!$income){
        //             $income = new Income;
        //         }
        //         $ids = @$item->users->wherein("type" , [3,5])->first()->id;
        //         if($ids){
        //           $ids = @$item->users->first()->id;
        //         }

        //         $income->price = $item->commission;
        //         $income->price_type = $item->commission_type;
        //         $income->date = $item->date;
        //         $income->note = $item->customer;
        //         $income->for_id = $ids;
        //         $income->type = "Income";
        //         $income->status = $item->status;
        //         $income->user_id = $item->user_id;
        //         $income->com = 1;
        //         $income->movement_id = $item->movement_id;
        //         $income->note = $item->customer;
        //         $income->save();
        //     }
        // }
        MovementUser::where("movement_id",$item->movement_id)->delete();
        
        if(!$id){
          if(Auth()->user()->type == 5){
            //$request->s_users = 19;
            //$request->s_users = Auth()->user()->id;
          }
        }
        
        if(isset($request->s_users) && $request->s_users != null ){
            MovementUser::create(["movement_id"=>$item->movement_id,"user_id"=>$request->s_users , "type"=>1]);
        }
        if(isset($request->l_users) && $request->l_users != null ){
            MovementUser::create(["movement_id"=>$item->movement_id,"user_id"=>$request->l_users , "type"=>0]);
        }
        


        if($request->ntext != null && $request->to_user_id != null){
            $nitem = Notification::where("movement_id",$item->movement_id)->first();
            if($nitem==null){
                $nitem = new Notification;
            }
            $old_text = $nitem->text;
            if($old_text != $request->ntext){
                //$nitem->title = $request->ntext;
                $nitem->text = $request->ntext;
                $nitem->type = 1;
                $nitem->movement_id = $item->movement_id;
                $nitem->from_user_id = $item->user_id;
                //$nitem->to_user_id = ;
                $nitem->status = 0;
                $nitem->date = Carbon::parse($item->date);
                $nitem->user_id = auth()->user()->id;
                $nitem->created_at = Carbon::now();
                $nitem->save();
                NotificationUser::where("notification_id" , $nitem->notification_id)->delete();
                foreach($request->to_user_id as $nuser){
                    NotificationUser::create(["notification_id"=>$nitem->notification_id,"user_id"=>$nuser]);
                }
            }
        }
        
        if($id){
            return redirect("admin/entries")->with('success' , __('UpDated'));
        }
            return redirect("admin/entries")->with('success' , __('Created'));
      }
      return redirect()->back()->with('danger' , __('Error Not Created'));
    }

}
