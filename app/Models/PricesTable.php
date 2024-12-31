<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PricesTypes;
use App\Models\PricesData;


class PricesTable extends Model
{
    protected $table = 'prices_table';
    protected $fillable = ['table_id ','type_id','title_table','desc_table'];
    protected $primaryKey = 'table_id';
    public $timestamps = false;

    public function PTypes()
    {
       return $this->hasOne(PricesTypes::class,'id','type_id');
    }
    public function PData()
    {
       return $this->hasMany(PricesData::class,'table_id','table_id');
    }
}
