<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PricesTable;
use App\Models\PricesTypesNote;

class PricesTypes extends Model
{
    protected $table = 'prices_types';
    protected $fillable = ['id ','title','title_page','desc_page','phone','email','url','address','note1','note2','note3'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function PTables()
    {
       return $this->hasMany(PricesTable::class,'type_id','id');
    }
    public function PNotes()
    {
       return $this->hasMany(PricesTypesNote::class,'type_id','id');
    }
}
