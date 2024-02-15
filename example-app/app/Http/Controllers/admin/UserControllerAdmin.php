<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Http\Requests\banner\AddBannerRequest;
use App\Http\Requests\banner\UpdateBannerRequest;
class UserControllerAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->keyword){
            $data= User::where('name','LIKE',"%$request->keyword%")->orwhere('email','LIKE',"%$request->keyword%")->orwhere('phone','LIKE',"%$request->keyword%")->paginate(5);
            $data->appends(['keyword' => $request->keyword]);
        }
        else{
            $data =User::orderBy('updated_at', 'DESC')->paginate(5);
        }
        return view('admin.views.user.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,User $user)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.views.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user,Request $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction(); 
        try {          
            $user->update($request->all());
            return $this->commonFunction->handleNotifyAndRedirect('success','Update user role successfully',$request,'/admin/user');
        } catch (\Throwable $th) { 
            return $this->commonFunction->handleNotifyAndRedirect2('error','user role fail',$request);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user,Request $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        try {
            $user->delete();
            return $this->commonFunction->handleNotifyAndRedirect3('success','Delete User successfully',$request,'/admin/user');
        } catch (\Throwable $th) {
            return $this->commonFunction->handleNotifyAndRedirect3('error','Delete User fail',$request);
        }  
    }
    public function trash(){
        $data=User::onlyTrashed()->paginate(5);
        return view('admin.views.user.trash',compact('data'));
    }


}
