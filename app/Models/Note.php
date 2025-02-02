<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['content' , 'user_id'];

    public function movements(){
        return $this->hasMany(\App\Models\MovementNote::class);
    }
}
