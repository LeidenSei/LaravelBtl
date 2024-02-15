<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable=['product_id','order_id','total_price','quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
