<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boxes extends Model
{
    protected $guarded=['id'];
    use HasFactory;
    public  function storage(){
        return $this->belongsTo(Storage::class);

    }
    public function slots(){
        return $this->hasMany(Slots::class, 'box_id');
    }
}
