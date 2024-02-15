<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WishList;
use App\Models\Blog;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use Hash;
use Auth;
use Str;
use Mail;
use App\Http\Requests\wishlist\wishlistRequest;
use App\Http\Requests\user\RegisterRequest;
class UserController extends Controller
{
    protected $commonFunction;
    protected $modelFunction;


    public function login()  {
        return view('fe.login');
    }
    public function postLogin(Request $request) {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->commonFunction->handleNotifyAndRedirect('success','Login successfully',$request,'/');
        }else{
            return $this->commonFunction->handleNotifyAndRedirect2('error','Invalid information',$request);
        }
    }


    public function register()  {
        return view('fe.register');
    }
    public function postRegister(RegisterRequest $request) {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        
        $request->merge(['password'=>Hash::make($request->password)]);
        try {
            User::create($request->all());
            return $this->commonFunction->handleNotifyAndRedirect('success','Login to your account you have registered',$request,'/login');
        } catch (\Throwable $th) {
            return $this->commonFunction->handleNotifyAndRedirect2('error','Register fail',$request);
        }
    }
    public function logout(Request $request)  {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        Auth::logout();
        return $this->commonFunction->handleNotifyAndRedirect2('success','Logout successfully',$request);
    }

    public function wishlist()  {
        
        $wishlist=WishList::paginate(5);
        $countWish=count($wishlist);
        return view('fe.wishlist',compact('wishlist','countWish'));
    }
    public function postWishList(wishlistRequest $request)  {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        
        try {
            WishList::create($request->all());
            return $this->commonFunction->handleNotifyAndRedirect2('success','Add to wishlist successfully',$request);
        } catch (\Throwable $th) {
            return $this->commonFunction->handleNotifyAndRedirect2('error','This wishlist already have',$request);
        }
    }
    public function removeWish(Request $request)  {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
       
        WishList::where('id',$request->id)->delete();
        return $this->commonFunction->handleNotifyAndRedirect2('success','Delete this wishlist successfully',$request);
    }

    public function blog(Request $request)  {
        $blog=Blog::paginate(9);
        if ($request->keyname) {
            $blog = Blog::where('name','LIKE',"%$request->keyname%")->orderBy('created_at','DESC')->paginate(9);
        }
        return view('fe.blog',compact('blog'));
    }
    public function  about()  {
        return view('fe.about');
    }
    public function detalBlog($slug) {
        $blog=Blog::where('slug',$slug)->first();
        $recentBlog=Blog::orderBy('created_at','DESC')->take(4)->get();
        return view('fe.blog_detail',compact('blog','recentBlog'));
    }
    public function forgot()  {
        return view('fe.forgot');
    }
    public function post_forgot(Request $request)  {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $request->validate([
            'email'=>'required|exists:users'
        ],[
            'email.exists'=>'Email is not exists'
        ]);


        $user=User::where('email',$request->email)->first();
       
        $token=strtoupper(Str::random(10));
        $user->update(['remember_token'=>$token]);

        Mail::send('email.check_email_forget',compact('user'),function($email)use($user){
            $email->subject('
            The House Store-Retrieve your password');
            $email->to($user->email,$user->name);
           
        });
        return $this->commonFunction->handleNotifyAndRedirect2('warning','Check your email to continue',$request);
    
        
    }
    public function getPass(User $user,$token,Request $request) {
        if ($user->remember_token===$token) {
           return view('fe.getPass');
        } else {
            return abort(404);
        }
        
    }
    public function postGetPass(User $user,$token,Request $request) {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $request->validate([
            'password'=>'required',
            'corfirm_password'=>'required|same:password'
        ]);
       $password=Hash::make($request->password);
       $user->update(['password'=>$password,'remember_token'=>null]);
       return $this->commonFunction->handleNotifyAndRedirect('success','Change password successfully,login again to continue',$request,'/login');
    }

    
}
