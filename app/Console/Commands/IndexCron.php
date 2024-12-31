<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Movement;
use App\Models\MovementUser;
use Carbon\Carbon;


class IndexCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ChangeDay:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ChangeDay Auto Color';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // ->where("movement_id","1554")
        $data = Movement::where("completed" , "0")->orderby("movement_id" , "DESC")->get();
        //dd($data);
        foreach($data as $item){
            $old_color = $item->color;
            if($item->completed == 0){
                $old_color = 0;
            }
            $date_comp = $item->date . " 23:55:00";
            $item->date = $item->date . " 14:00:00";
            $created = new Carbon($item->date);
            $now = Carbon::now()->format("Y-m-d H:m:s");
            
            $now_c = Carbon::now()->format("Y-m-d");
            $now_cd = Carbon::parse($item->date)->format("Y-m-d");
            $ns_created = Carbon::parse($item->created_at)->format("Y-m-d");
            
            
            $difference = $created->diffInDays()+1;
            $created2 = new Carbon($item->to_date);
            $difference2 = $created2->diffInDays()+1;
            //dd($item->date,$difference,$item->to_date,$difference2);
            
            $C_on_this_data = false;
            if(($now_cd == $ns_created) && ($ns_created == $now_c)){
                $C_on_this_data = true;
            }
            if($date_comp < $now && $item->to_date == null && $difference >= 1 && $C_on_this_data == false){
                $item->color = 3;
                $item->completed = 1;
            }
            else if($item->date > $now && ($difference == "0" || $difference == "1")  && $item->to_date == null ){
                $item->color = 1;
            }
            else if(($difference == "0" || $difference == "1" )  && $item->to_date == null){
                //dd($difference,$item);
                $item->color = 1;
            }else if(($difference >= "2" && $difference <= "20")  && $item->to_date == null){
                $item->color = 2; //2 5
            }else if($difference > "20" && $item->to_date == null){
                $item->color = 5;
            }else if($item->to_date != null){
                $item->to_date = $item->to_date." 14:00:00";
                $to_date_comp = $item->date . " 23:55:00";
                if($item->date <= $now && $item->to_date >= $now){
                    if($item->color != 4){
                        $item->color = 1; // 4
                    }
                }else if(($difference == "0" || $difference == "1")){
                    //$item->color = 1;
                    if($item->color != 4){
                        $item->color = 1; // 4
                    }
                }else if($item->date < $now && $to_date_comp < $now){
                    //if($item->color != 4){
                        $item->color = 3;
                        $item->completed = 1;
                    //}
                }else if($difference2 <= "20"){
                    $item->color = 2; // 2 5
                }else if($difference2 > "20"){
                    $item->color = 5;
                }
            }
            //dd($item);
            if($old_color != $item->color){
                $item->save();
            }
        }
        //dd("Done");

    }
}
