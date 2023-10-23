<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected  $guarded=['id'];
    use HasFactory;
    public function boxes()
    {
        return $this->hasMany(Boxes::class);
    }

}
