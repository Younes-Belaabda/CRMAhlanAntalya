<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Notification;


class NotificationUser extends Model
{
    protected $table = 'notification_user';
    protected $fillable = ['notification_user_id','notification_id','user_id'];
    protected $primaryKey = 'notification__user_id';

    //  public function scopefilterdate($data, $request){
    //    if(isset($request['date_to']) && $request['date_to'] != null){
    //        $data->whereBetween('created_at',[$request['date_from'] , $request['date_to']]);
    //    }else if(isset($request['date_from']) && $request['date_from'] != null){
    //        $data->whereDate('created_at',$request['date_from']);
    //    }
    //    return $data;
    //  }
    
    public function notification()
    {
       return $this->hasOne(Notification::class,'notification_id','notification_id')->with("f_user");
    }
}
