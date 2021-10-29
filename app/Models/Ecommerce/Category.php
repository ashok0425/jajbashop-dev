<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $connection='mysql2';

    public function subcategory(){
        return $this->hasMany(subcategory::class,'category_id','id');
    }
}
