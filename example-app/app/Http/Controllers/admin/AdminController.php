<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Blog;
use App\Http\Requests\admin\LogonRequest;
class AdminController extends Controller
{
    protected $commonFunction;
    protected $modelFunction;
    public function logon() {
        return view('admin.views.logon');
    }
    public function postlogon(LogonRequest $request) {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password,'role'=>1])){
            return $this->commonFunction->handleNotifyAndRedirect('success','Logon successfully',$request,'/admin');
        }
        return $this->commonFunction->handleNotifyAndRedirect2('error','Logon fail',$request);
    }
    
    public function adminlogout(Request $request) {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        Auth::logout();
        return $this->commonFunction->handleNotifyAndRedirect('success','Logout successfully',$request,'/logon');
         
      }
      public function index()  {
        $product_count=Product::count();
        $order_count=Order::count();
        $cus_count=User::count();
        $blog_count=Blog::count();
        return view('admin.views.index',compact('product_count','order_count','cus_count','blog_count'));
      }
}
