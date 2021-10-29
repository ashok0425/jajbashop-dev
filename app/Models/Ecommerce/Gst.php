<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gst extends Model
{
    use HasFactory;
    public $connection='mysql2';
    protected $fillable = [
        'hsn',
        'detail',
        'percent',
    ];
}
