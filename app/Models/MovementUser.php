<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;


class MovementUser extends Model
{
    protected $table = 'movement_user';
    protected $fillable = ['movement_user_id','movement_id','user_id','type'];
    protected $primaryKey = 'movement_user_id';

    //  public function scopefilterdate($data, $request){
    //    if(isset($request['date_to']) && $request['date_to'] != null){
    //        $data->whereBetween('created_at',[$request['date_from'] , $request['date_to']]);
    //    }else if(isset($request['date_from']) && $request['date_from'] != null){
    //        $data->whereDate('created_at',$request['date_from']);
    //    }
    //    return $data;
    //  }
    
    public function user()
    {
       return $this->hasOne(User::class,'id','user_id');
    }
}
