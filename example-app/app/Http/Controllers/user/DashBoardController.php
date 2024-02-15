<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth;
use Hash;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
class DashBoardController extends Controller
{
    protected $commonFunction;
    protected $modelFunction;
    public function index(Request $request ,$id)  {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $user=User::find($id);
        $order=Order::where('user_id',$id)->orderBy('created_at','DESC')->get();
        if($request->address){

            $validate=$request->validate([
                'address'=>'required'
            ]);
           try {
            User::find($id)->update($request->all());
            return $this->commonFunction->handleNotifyAndRedirect('success','Update address successfully',$request, '/dashboard'.'/'.$id);
           } catch (\Throwable $th) {
             return $this->commonFunction->handleNotifyAndRedirect('error','Update address failed',$request, '/dashboard'.'/'.$id);
           }    
        }
        return view('fe.dashboard',compact('user','order'));
    }
    public function logoutDashboard(Request $request)  {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        Auth::logout();
        return $this->commonFunction->handleNotifyAndRedirect('success','You need to login to access to dashboard',$request,'/login');
    }
    public function changePassword(Request $request ,$id)  {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $user=User::find($id);
        $active='';
        $validate=$request->validate([
            'passwordOld'=>'required',
            'password'=>'required|min:6|different:passwordOld',
            'repassword'=>'min:6|same:password|required' 
        ]);
        if(Hash::check($request->passwordOld, $user->password)){
            $user=User::find($id)->update(['password'=>$request->password]);
            if($user){
                Auth::logout();
                
                return $this->commonFunction->handleNotifyAndRedirect('success','You changed password you need to login again',$request,'/login');
            }
        }else{
            return $this->commonFunction->handleNotifyAndRedirect2('error','Change password fail',$request);
        }
    }
    public function updateprofile($id,Request $request) {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $validate=$request->validate([
            'name'=>'required|min:2',
            'phone'=>['required','regex:/(84|0[3|5|7|8|9])+([0-9]{8})/','max:10'],
            'address'=>'required' 
        ]);
        if($request->photo!=''){
            $file_name=$request->photo->getClientOriginalName();
            $request->merge(['avatar'=>$file_name]);
            $request->photo->storeAs('public/images',$file_name);
            
        } 
        try {       
            $user=User::find($id)->update($request->all());
            return $this->commonFunction->handleNotifyAndRedirect2('success','Update success',$request);
        } catch (\Throwable $th) { 
            return redirect()->back()->with('error','Update fail');
        }  
       
        
    }
    public function orderDetail($id){
        $order=Order::find($id);
        $detail=OrderDetail::where('order_id',$id)->get();
        $total_price=OrderDetail::where('order_id',$id)->sum('total_price');
        return view('fe.order_detail',compact('detail','total_price','order'));
    }
    public function cancelOrder($id,Request $request) {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        Order::find($id)->update(['status'=>4]);
        return $this->commonFunction->handleNotifyAndRedirect2('success','Cancel order successfully',$request);
        
    }
    public function RestoreOrder($id,Request $request) {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        Order::find($id)->update(['status'=>0]);
        return $this->commonFunction->handleNotifyAndRedirect2('success','Restore order successfully',$request);
        
    }
    public function deleteOrder($id,Request $request) {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        OrderDetail::where('order_id',$id)->delete();
        Order::destroy($id);
        return $this->commonFunction->handleNotifyAndRedirect2('success','Delete order successfully',$request);
        
    }
}
