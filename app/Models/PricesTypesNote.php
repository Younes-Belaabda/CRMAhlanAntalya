<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PricesType;

class PricesTypesNote extends Model
{
    protected $table = 'prices_types_note';
    protected $fillable = ['note_id ','title','desc_note','type_id'];
    protected $primaryKey = 'note_id';
    public $timestamps = false;

    public function PType()
    {
       return $this->hasMany(PricesType::class,'type_id','id');
    }
}
