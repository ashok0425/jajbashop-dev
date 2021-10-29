<?php

namespace App\Models\Ecommerce;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory; public $connection='mysql2';
    public function cat(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
