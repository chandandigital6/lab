<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slots extends Model
{
    protected $guarded=['id'];
    use HasFactory;
    public function boxes(){
        return $this->belongsTo(Boxes::class);
    }
    public function items(){
        return $this->hasMany(items::class,'slot_id');
    }
}
