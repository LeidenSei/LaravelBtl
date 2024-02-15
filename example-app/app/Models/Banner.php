<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\CommonFunction\CommonFunction;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Http\Request;
class Banner extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','image','status'];
    function getAllBanner()
    {   

            return DB::table('banners')
                ->whereNull('banners.deleted_at')
                ->select('banners.*')
                ->orderBy('id', 'desc')
                ->paginate(2);
    }
    public function getAllBannerByFind($find) {
        return DB::table('banners')
        ->select('banners.*')
        ->where('banners.name', 'like', '%'.$find.'%')
        ->orWhere('banners.id', 'like', '%'.$find.'%')
        
        ->whereNull('banners.deleted_at');
        
    }
    

}
