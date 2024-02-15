<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use Auth;
use Mail;
use App\Http\Requests\user\OrderRequest;
class OrderUserController extends Controller
{
    protected $commonFunction;
    protected $modelFunction;
    public function checkout(Cart $cart,Request $request) {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        if($cart->items==[]){
            return $this->commonFunction->handleNotifyAndRedirect2('error','You dont have anything to checkout',$request);
            

        }
        if (Auth::check()) {
            return view('fe.checkout',compact('cart'));  
        } else {
            return $this->commonFunction->handleNotifyAndRedirect2('error','You need login to checkout',$request);
        }
        
         
    }
    public function success() {
        return view('fe.checkout_success');
    }
    public function postcheckout(OrderRequest $request,Cart $cart)  {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        if(Auth::check()){
         $user_id= Auth::user()->id;
         $user=User::find($user_id)->update($request->all());
         $user=User::find($user_id);
        }else{
            return $this->commonFunction->handleNotifyAndRedirect2('error','You need login to checkout',$request);
        }
        
        try {
        if( 
         $order=Order::create([
         'user_id'=>$user_id,
         'payType'=>$request->payType,
         'order_note'=>$request->order_note,
         ])
         ){
             $order_id=$order->id;
             foreach($cart->items as $product_id => $item){
                 $quantity=$item['quantity'];
                 $price=$item['price'];
                 $total_price=$quantity*$price;
                 OrderDetail::create([
                     'order_id'=>$order_id,
                     'product_id'=>$product_id,
                     'total_price'=>$total_price,
                     'quantity'=>$quantity
                 ]);
             }
          };

          Mail::send('email.order',compact('order','user'),function ($email) use($user){
            $email->subject('The House Store-Checkout successfully');
            $email->to($user->email,$user->name);
        });
         session(['cart'=>'']);
         return redirect()->route('checkout.success');
        } catch (\Throwable $th) {
         dd($th);
        }
     
     }
}
