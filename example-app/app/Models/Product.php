<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $appends = ['isfavorite'];

    protected $fillable=['name','slug','price','sale_price','image','description','status','category_id','stock'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function images()
    {
        return $this->hasMany(ImgProduct::class);
    }
    // public function reviews()
    // {
    //     return $this->hasMany(ReviewProduct::class);
    // }
    // public function review()
    // {
    //     return $this->belongsTo(ReviewProduct::class);
    // }
    public function reviews()
    {
        return $this->hasMany(ReviewProduct::class);
    }

    public function getIsfavoriteAttribute() {
        $userId = auth()->id();
        $check = WishList::where(['product_id' => $this->id, 'user_id' => $userId])->first();

        return $check ? true : false;
    }

}
