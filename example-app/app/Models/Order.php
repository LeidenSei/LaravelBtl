<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','payType','order_note','status'];

    public function cus()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
