<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Models\Category;
class CartController extends Controller
{
    public function index(Cart $cart) {
        // dd($cart->list());
        return view('fe.cart',compact('cart'));
    }
    public function add(Request $request,Cart $cart) {
        
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        Wishlist::where('product_id',$request->id)->delete();
        $product=Product::find($request->id);
        $quantity=$request->quantity;
        $cart->add($product,$quantity);

        return $this->commonFunction->handleNotifyAndRedirect2('success','Add to cart successfully',$request);
    }


    public function remove(Cart $cart,$id)  {
        $cart->remove($id);
        return redirect()->back();
    }
    public function update(Cart $cart,Request $request)  {
      
        $cart->update($request->id,$request->quantity);
        return redirect()->back();
    }
    public function clear(Cart $cart){
        $cart->clear();
        return redirect()->back();
    }
}
