<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\MovementUser;


class Countries extends Model
{
    protected $table = 'countries';
    protected $fillable = ['countries_id ','name','user_id ','status',"image"];
    protected $primaryKey = 'countries_id';

    public function getAvatarAttribute()
    {
      $image = @$this->image;
      if($image == '' || $image == ' ' || $image == null)
        $image = 'default.png';

      //return url('assets/img/team-2.jpg');
      return admin_url('images/'. $image);
    }
    public function m_user()
    {
       return $this->hasOne(User::class,'id','user_id');
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
