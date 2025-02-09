<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovementNote extends Model
{
    protected $fillable = ['movement_id' , 'note_id'];

    public function note(){
        return $this->belongsTo(Note::class);
    }

    public function movement(){
        return $this->belongsTo(Movement::class);
    }
}
