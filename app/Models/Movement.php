<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Countries;
use App\Models\MovementUser;
use App\Models\Notification;


class Movement extends Model
{
    protected $table = 'movement';
    protected $fillable = ['movement_id ','customer','hotel','middleman','date','to_date','time','to_time','description','price','price_type','net','net_tl','admin_partner','leader_paid','sender_paid',
    'revenue','revenue_partner','commission','type','color','paybyus','country_id','user_id','status','commission_type','completed','commit',
    'admin_commission','admin_commission_type','tax',"sec_price","sec_price_type","t_net","t_profit","t_paid"];
    protected $primaryKey = 'movement_id';

    public function users()
    {
        return $this->belongsToMany(User::class,'movement_user','movement_id','user_id')->orderby("type","Desc");
    }
    public function m_user()
    {
       return $this->hasOne(User::class,'id','user_id');
    }
    public function sender_user()
    {
       return $this->hasOne(MovementUser::class,'movement_id','movement_id')->where("type",1);
    }
    public function leader_user()
    {
       return $this->hasOne(MovementUser::class,'movement_id','movement_id')->where("type",0);
    }
    
    public function musers()
    {
       return $this->hasMany(MovementUser::class,'movement_id','movement_id')->orderby("type","DESC")->with("user");
    }
    public function country()
    {
       return $this->hasOne(Countries::class,'countries_id','country_id');
    }
    public function notification()
    {
       return $this->hasOne(Notification::class,'movement_id','movement_id');
    }

    public function getColorHashAttribute()
    {
        $color = "#ffffff";
        if($this->color == "1"){
            $color = "#ff0000"; // احمر
        }
        else if($this->color == "2"){
            $color = "#fffc00"; // اصفر
        }
        else if($this->color == "3"){
            $color = "#12ff00"; // اخضر
        }
        else if($this->color == "4"){
            $color = "#00fff0"; // ازرق
        }
        else if($this->color == "5"){
            $color = "#ff9933";  // برتقالي
        }
        return $color;
    }

    //  public function scopefilterdate($data, $request){
    //    if(isset($request['date_to']) && $request['date_to'] != null){
    //        $data->whereBetween('created_at',[$request['date_from'] , $request['date_to']]);
    //    }else if(isset($request['date_from']) && $request['date_from'] != null){
    //        $data->whereDate('created_at',$request['date_from']);
    //    }
    //    return $data;
    //  }
}
