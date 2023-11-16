<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vender extends Model
{
    protected $guarded=['id'];
    use HasFactory;


    protected $casts = [
        'product_categories' => 'json',
    ];

    public function categories(){
        return $this->hasMany(ProductCategory::class, 'id', 'product_categories');
    }
}
