<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\MovementUser;
use App\NotificationUser;


class Notification extends Model
{
    protected $table = 'notification';
    protected $fillable = ['notification_id','notification_ids','title','text','type','movement_id','from_user_id','to_user_id','user_id ','status','date'];
    protected $primaryKey = 'notification_id';

    public function users()
    {
        return $this->belongsToMany(User::class,'notification_user','notification_id','user_id');
    }
    
    public function m_user()
    {
       return $this->hasOne(User::class,'id','user_id');
    }

    public function f_user()
    {
       return $this->hasOne(User::class,'id','from_user_id');
    }
    public function t_user()
    {
       return $this->hasOne(User::class,'id','to_user_id');
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
