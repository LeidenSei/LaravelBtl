<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ReviewProduct;
use App\Models\Blog;
use App\Models\Banner;
use App\Models\WishList;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use Mail;
class HomeController extends Controller
{
    protected $commonFunction;
    protected $modelFunction;
    public function index() {
        $featureProduct=Product::where('stock',1)
        ->get();
        
        $cate=Category::all();
        $banner=Banner::orderBy('created_at','DESC')->where('status',1)->take(3)->get();
        $blog=Blog::orderBy('created_at','DESC')->take(3)->get();
        $wishlist=WishList::all();
        $product=Product::orderBy('created_at','DESC')->take(12)->get();
        return view('fe.home',compact('featureProduct','cate','product','blog','banner','wishlist'));
    }
    public function detail($slug) {
        $product=Product::where('slug',$slug)->first();


        $related=Product::where('category_id',$product->category_id)->where('id','!=',$product->id)->get();
        $featureProduct=Product::where('stock',1)
        ->take(3)->get();
        
        $review=ReviewProduct::where('product_id',$product->id)->orderBy('created_at','DESC')->paginate(3);
        $reviews=ReviewProduct::where('product_id',$product->id)->get();

        $latestPro = Product::latest()->take(3)
        ->get();

        $count = count($reviews);


        $nextProduct = Product::where('id', '>', $product->id)->where('category_id',$product->category_id)->first();
        // dd($nextProduct->slug);
        $previousProduct =  Product::where('id', '<', $product->id)->where('category_id',$product->category_id)->first();
        if ($previousProduct === null) {
            return view('fe.detail',compact('product','related','featureProduct','review','count','latestPro','nextProduct'));
        } else if($nextProduct===null) {
             return view('fe.detail',compact('product','related','featureProduct','review','count','latestPro','previousProduct'));
        } else{
            return view('fe.detail',compact('product','related','featureProduct','review','count','latestPro','nextProduct','previousProduct'));
        }

    }
    public function review(Request $request) {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $validate=$request->validate([
            'rating_star'=>'required' ,
            'name'=>'required' 
        ]);
        try {
        ReviewProduct::create($request->all());
        return $this->commonFunction->handleNotifyAndRedirect2('success','Add review successfully',$request);
        } catch (\Throwable $th) {
            return $this->commonFunction->handleNotifyAndRedirect2('error','Add review failed',$request);
        }
       
    }

    public function shopByCate(Request $request) {
        $cate=Category::all();
        $cateName='';
        $featureProduct=Product::where('stock',1)
        ->take(3)->get();
        $featureProduct2=Product::where('stock',1)
        ->whereNotIn('id', $featureProduct->pluck('id'))
        ->take(3)->get();
 
        $product=Product::paginate(8)->withQueryString();
        if ($request->keyword) {
            $product=Product::where('name','LIKE',"%$request->keyword%")->paginate(8)->withQueryString();
            $cateName="Product name like".': '.$request->keyword;
        }
        if ($request->cate) {
            $cateSearch=Category::where('slug',$request->cate)->get();
            $cateName=$request->cate;
            $product=Product::where('category_id',$cateSearch[0]->id)->paginate(8)->withQueryString();
            
        }

        if($request->sort){
            if($request->sort==1){
                $product = Product::where('stock','1')
                ->paginate(8)->withQueryString();  
                $cateName="Popularity";
            }
            if($request->sort==2){
                $product = Product::orderBy('created_at','DESC')->paginate(8)->withQueryString(); 
                $cateName="Newest";
            }
            if($request->sort==3){
                $product = Product::orderBy('sale_price','ASC')->paginate(8)->withQueryString(); 
                $cateName="Low to high";
            }
            if($request->sort==4){
                $product = Product::orderBy('sale_price','DESC')->paginate(8)->withQueryString(); 
                $cateName="High to low";
            }
            if($request->sort==5){
                $product = Product::orderBy('name','ASC')->paginate(8)->withQueryString(); 
                $cateName="A-Z";
            }
            if($request->sort==6){
                $product = Product::orderBy('name','DESC')->paginate(8)->withQueryString(); 
                $cateName="Z-A";
            }
        }
        if($request->min_price){
            $product = Product::whereBetween('sale_price', [$request->min_price, $request->max_price])->paginate(8)->withQueryString(); 
            $cateName='Between'.' :'.$request->min_price.'$'.'->'.$request->max_price.'$';
            if($request->sort=="5"){
                $product = Product::whereBetween('sale_price', [$request->min_price, $request->max_price])->orderBy('name','ASC')->paginate(8)->withQueryString();
                $cateName="A-Z".' Between'.' :'.$request->min_price.'$'.'->'.$request->max_price.'$';
            }elseif($request->sort=="6"){
                $product = Product::whereBetween('sale_price', [$request->min_price, $request->max_price])->orderBy('name','DESC')->paginate(8)->withQueryString();  
                $cateName="Z-A".' Between'.' :'.$request->min_price.'$'.'->'.$request->max_price.'$';
            }elseif($request->sort=="3"){
                $product = Product::whereBetween('sale_price', [$request->min_price, $request->max_price])->orderBy('sale_price','ASC')->paginate(8)->withQueryString();  
                $cateName="Low to high".' Between'.' :'.$request->min_price.'$'.'->'.$request->max_price.'$';
            }elseif($request->sort=="4"){
                $product = Product::whereBetween('sale_price', [$request->min_price, $request->max_price])->orderBy('sale_price','DESC')->paginate(8)->withQueryString();  
                $cateName="High to low".' Between'.' :'.$request->min_price.'$'.'->'.$request->max_price.'$';
            }elseif($request->sort=="2"){
                $product = Product::whereBetween('sale_price', [$request->min_price, $request->max_price])->orderBy('created_at','DESC')->paginate(8)->withQueryString(); 
                $cateName="Newest".' Between'.' :'.$request->min_price.'$'.'->'.$request->max_price.'$'; 
            }elseif($request->sort=="1"){
                $product = Product::whereBetween('sale_price', [$request->min_price, $request->max_price])->where('stock','1')->paginate(8)->withQueryString();  
                $cateName="Popularity".' Between'.' :'.$request->min_price.'$'.'->'.$request->max_price.'$';
            }
        }

        return view('fe.shop',compact('cate','product','featureProduct','featureProduct2','cateName'));
    }

    public function contact()  {
        return view('fe.contact');
    }
    public function test() {
        $name='Bùi';
        Mail::send('emails.test',compact('name'),function($email)use ($name){
            $email->subject('Demo test mail');
            $email->to('hoangdang77bg@gmail.com',$name);
        });
    }
}
