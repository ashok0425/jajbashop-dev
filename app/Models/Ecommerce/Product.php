<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;
     public $connection='mysql2';
  



    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'short_desc'
            ]
        ];
    }


}
