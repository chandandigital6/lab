<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectCategory extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class,'product_category_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }

}
