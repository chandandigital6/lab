<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteEnquery extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'ProductCategory_id');
    }

}
