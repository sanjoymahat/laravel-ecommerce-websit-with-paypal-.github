<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insert_Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable =[
    'name', 
    'description',
    'price',
    'sale_price', 
    'quantity',
    'category',
    'type',
    'image' ];
}
