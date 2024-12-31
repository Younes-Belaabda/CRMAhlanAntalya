<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PricesTypes;
use App\Models\PricesTable;


class PricesData extends Model
{
    protected $table = 'prices_data';
    protected $fillable = ['data_id ',"table_id",'title','star','desc_data','s5','s6','s12','s24','s50'];
    protected $primaryKey = 'data_id';
    public $timestamps = false;

    public function PTable()
    {
       return $this->hasOne(PricesTable::class,'table_id','data_id');
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
