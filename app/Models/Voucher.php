<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VoucherRoom;

class Voucher extends Model
{
    protected $table = 'voucher';
    protected $fillable = ['id ','type','gneder','name','date','Num','cin','cout'
                           ,'status','hotel','address','b_amount','p_amount','note','user_id'
                           ];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function VRoom()
    {
       return $this->hasMany(VoucherRoom::class,'voucher_id','id')->orderby("room_id","DESC");
    }
}
