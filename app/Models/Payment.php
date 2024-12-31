<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Payment extends Model
{
    protected $table = 'testpayment';
    protected $fillable = ['id ','name','pan','date','cv2','phone','amount','currency','res','status', 'craeted_at'];
    protected $primaryKey = 'id';

}
