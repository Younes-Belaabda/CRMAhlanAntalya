<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Debt extends Model
{
    protected $table = 'debt';
    protected $fillable = ['debt_id ','price','price_type','date','note','for_id','type','status','user_id'];
    protected $primaryKey = 'debt_id';

    public function for_user()
    {
       return $this->hasOne(User::class,'id','for_id');
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
