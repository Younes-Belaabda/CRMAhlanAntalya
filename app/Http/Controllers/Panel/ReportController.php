<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Notification;
use Validator;
use Carbon\Carbon;
use App\Models\Countries;
use App\Models\Movement;
use App\Models\MovementUser;
use App\Models\Income;
use DB;

class ReportController extends Controller
{
    public function __construct()
    {
       $this->middleware('IsAdmin');
    }

    public static function sumAmountByCurrency($collection, $currency)
    {
        $net =  $collection->where('price_type', $currency)->sum('net');
        $commission =  $collection->where('price_type', $currency)->sum("commission");
        return $net + $commission;
    }

    public function source_service(Request $request)
    {
        $data = collect();
        $users_data = User::wherehas("movements" , function($q) use($request){
            if(isset($request->country_id) && $request->country_id != null){
                $q->where("country_id" , $request->country_id);
            }
            if(isset($request->m_type) && $request->m_type != null){
                $q->where("type" , $request->m_type);
            }

            if($request->from_date != null && $request->to_date == null){
                $q->where("date" , $request->from_date);
            }
            if($request->from_date != null && $request->to_date != null){
                $q->whereBetween("date" , [$request->from_date,$request->to_date]);
            }
            $q->where("status" , "1");
        });

        if(isset($request->type) && $request->type != null){
            $users_data = $users_data->where("type" , $request->type);
        }
        if(isset($request->d_user) && $request->d_user != null){
            $users_data = $users_data->where("id" , $request->d_user);
        }
        $users_data = $users_data->get();

        foreach($users_data as $key=>$dt){
            $itemdata = collect();
            $movem = Movement::wherehas("users" , function($q) use($dt , $request){
                $q->where("user_id" , $dt->id);
            });

            if(isset($request->m_type) && $request->m_type != null){
                $movem = $movem->where("type" , $request->m_type);
            }
            if(isset($request->country_id) && $request->country_id != null){
                $movem = $movem->where("country_id" , $request->country_id);
            }
            if($request->from_date != null && $request->to_date == null){
                $movem = $movem->where("date" , $request->from_date);
            }
            if($request->from_date != null && $request->to_date != null){
                $movem = $movem->whereBetween("date" , [$request->from_date,$request->to_date]);
            }
            $movem = $movem->where("status" , "1")->get();

            $itemdata->put("user_id" , $dt->id);
            $itemdata->put("full_name" , $dt->full_name);
            $itemdata->put("C1" , $this->sumAmountByCurrency($movem , "$"));
            $itemdata->put("C2" , $this->sumAmountByCurrency($movem , "TL"));
            $itemdata->put("C3" , $this->sumAmountByCurrency($movem , "€"));
            $itemdata->put("C4" , $this->sumAmountByCurrency($movem , "£"));
            $data->push($itemdata);
        }
        //dd($data);

        $income = Income::query();
        if($request->from_date != null && $request->to_date == null){
            $income = $income->where("date" , $request->from_date);
        }
        if($request->from_date != null && $request->to_date != null){
            $income = $income->whereBetween("date" , [$request->from_date,$request->to_date]);
        }
        $income = $income->where("status" , "1")->get();

        $users = User::get();
        $countries = Countries::get();
        $request = $request->all();

        return view('panel.Report.source_service' , compact('data','income','users','countries','request'));
    }


    public function summary(Request $request)
    {
        $thisYear = date("Y");
        $thisMonth = date("m");
        $date = date("Y-m-d");
        $data = DB::table('movement as m')->select("m.*","u.type as u_type",DB::raw("DATE_FORMAT(date, '%Y') new_year"),DB::raw("DATE_FORMAT(date, '%M %Y') new_date"),
                DB::raw('count(m.movement_id) as "tb"'),
                DB::raw('sum(m.revenue) as "tp"'),
                DB::raw('sum(m.net) as "tn"'),
                DB::raw('sum(m.commission) as "tc"'),
                DB::raw('YEAR(m.date) year, MONTH(m.date) month')
        );
        // $data = DB::table('movement as m')
        //     ->select(
        //         "price_type","commission_type","mu.user_id","u.full_name","m.status","u.background","u.color","u.type",
        //         DB::raw("DATE_FORMAT(m.date, '%Y') new_year"),
                //DB::raw('count(m.movement_id) as "tb"'),
                //DB::raw('sum(m.revenue) as "tp"'),
                //DB::raw('sum(m.net) as "tn"'),
                //DB::raw('sum(m.commission) as "tc"'),
                //DB::raw('YEAR(m.date) year, MONTH(m.date) month'),
        //         DB::raw("DATE_FORMAT(m.date, '%M %Y') new_date")
        //     );
        if(isset($request->d_user) && $request->d_user != null){
            $data = $data->wherehas("users" , function (Builder $query) use($user , $request){
                $query->where("id" , $request->d_user);
            });
        }
        if(isset($request->country_id) && $request->country_id != null){
            $data = $data->where("country_id" , $request->country_id);
        }
        if(isset($request->m_type) && $request->m_type != null){
            $data = $data->where("m.type" , $request->m_type);
        }
        if(isset($request->type) && $request->type != null){
            $data = $data->where("u.type" , $request->type);
        }

        if($request->from_date != null && $request->to_date == null){
            $data = $data->where("date" , $request->from_date);
            
            $date = $request->from_date;
        }
        if($request->from_date != null && $request->to_date != null){
            $data = $data->whereBetween("date" , [$request->from_date,$request->to_date]);
            $date = $request->from_date;
            //$date = date("M Y",strtotime($request->from_date));
        }

        if($request->from_date == null && $request->to_date == null){
            $data = $data->whereYear("date" , $thisYear)->whereMonth("date",$thisMonth);
        }

        $data = $data->join('movement_user as mu', function($join) {
                    $join->on('mu.movement_id', '=', 'm.movement_id');
                })
                ->join('users as u', function($joins) {
                    $joins->on('u.id', '=', 'mu.user_id');
                });
        
        $data = $data->where("m.status" , "1");
        
        $data_up = $data;
        $data_y = $data;
        $data_u = User::groupBy("type")->wherehas("movements");
        if(isset($request->type) && $request->type != null){
            $data_u = $data_u->where("type" , $request->type);
        }
        $data_u = $data_u->get();
        
        $data_c = $data;
        $data_p = $data;
        
        
        $data_y = $data_y->orderby("type" , "asc")->groupBy('new_date')->get();
        $data_up = User::wherehas("movements")->with("movements");
        if(isset($request->type) && $request->type != null){
            $data_u = $data_u->where("type" , $request->type);
        }
        $data_up = $data_up->get();

        //$data_u = $data_u->orderby("type" , "asc")->groupBy("new_date", "u.user_id")->get();

        $data_c = $data_c->orderby("type" , "asc")->groupBy("commission_type")->get();
        $data_p = $data_p->orderby("type" , "asc")->groupBy('new_date',"price_type")->get();

        // $data_up = $data_up->orderby("u.type" , "asc")->groupBy('new_date', "u.type")->get();
        // $data_y = $data_y->orderby("u.type" , "asc")->groupBy('new_date')->get();
        // $data_u = $data_u->orderby("u.type" , "asc")->groupBy('new_date', "mu.user_id")->get();

        // $data_c = $data_c->orderby("u.type" , "asc")->groupBy('new_date',"commission_type" , "mu.user_id")->get();
        // $data_p = $data_p->orderby("u.type" , "asc")->groupBy('new_date',"price_type" , "mu.user_id")->get();
        
        $currancy = collect();
        $currancy->push("$","TL","€","£");
        
        $user_type = collect();
        $user_type->push("Admin","Driver","Agent","Vendor","Partner");
        
        //$users = collect();
        //dd($data_c);
        // foreach($data_y as $i_year){
        //     $year = collect();
        //     $year->push(["date"=>$i_year->new_date]);
        //     //dd($year);
        //     foreach($data_u as $i_user){
        //         if($i_user->new_date == $i_year->new_date){
        //             $users->push(["user_id"=>$i_user->user_id]);
        //             $users->push(["full_name"=>$i_user->user_id]);
        //             $com = collect();
        //             foreach($data_c as $move_item){
        //                 if($move_item->user_id == ){

        //                 }
        //                 $com->push([]);
        //             }
        //         }
        //     }
        // }
        //dd($data_c);
        //dd($data);

       $users = User::get();
       $countries = Countries::get();
       $request = $request->all();
        return view('panel.Report.summary' , compact('date','currancy','data_y','data_u','data_up','data_p','data_c','user_type','users','countries','request'));
    }



}
