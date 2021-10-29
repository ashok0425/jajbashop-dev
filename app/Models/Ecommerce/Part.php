<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Part extends Model
{
    use HasFactory; public $connection='mysql2';

    public function cat(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function subcat(){
        return $this->belongsTo(Subcategory::class,'subcategory_id','id');
    }
    public function modal(){
        return $this->belongsTo(Modal::class,'modal_id','id');
    }
}
