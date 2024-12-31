<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Voucher;

class VoucherRoom extends Model
{
    protected $table = 'voucher_rooms';
    protected $fillable = ['room_id ','voucher_id','rooms','view','pax','board','no_room'];
    protected $primaryKey = 'room_id';
    public $timestamps = false;

    public function VRoom()
    {
       return $this->hasOne(Voucher::class,'voucher_id','id');
    }
}
