<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public static function updateTotalSum($totalSum)
    {
        Project::query()->update(['total_sum' => $totalSum]);
    }
    public function quote(){
        return $this->belongsTo(Quote::class,'id');
    }
}
