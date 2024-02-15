<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Http\Requests\banner\AddBannerRequest;
use App\Http\Requests\banner\UpdateBannerRequest;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $commonFunction;
     protected $modelFunction;
    public function index(Request $request)
    {
       
            $banner = Banner::orderBy('updated_at', 'DESC')->paginate(5);
        
        
        return view('admin.views.banner.index',compact('banner'));
    }

    public function find(Request $request) {
        
        $banner= Banner::where('name','LIKE',"%$request->keyword%")->orwhere('id','LIKE',"%$request->keyword%")->paginate(5);
        $banner->appends(['keyword' => $request->keyword]);
        return view('admin.views.banner.index',compact('banner'));
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.views.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddBannerRequest $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $file_name=$request->photo->getClientOriginalName();
        $request->photo->storeAs('public/images',$file_name);
        $request->merge(['image'=>$file_name]); 
        if ($request->has('status')){
            $request['status'] = 1;
        } else {
            $request['status'] = 0;
        } 
        try {       
            Banner::create($request->all());
            return $this->commonFunction->handleNotifyAndRedirect('success','Add Banner successfully',$request,'/admin/banner');
        } catch (\Throwable $th) { 
            return $this->commonFunction->handleNotifyAndRedirect2('error','Add banner fail',$request);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.views.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Banner $banner,UpdateBannerRequest $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        if(!$request->photo ==''){
            $file_name=$request->photo->getClientOriginalName();
            $request->photo->storeAs('public/images',$file_name);
            $request->merge(['image'=>$file_name]);  
        }
        if ($request->has('status')){
            $request['status'] = 1;
        } else {
            $request['status'] = 0;
        } 
        try {            
            $banner->update($request->all());
            return $this->commonFunction->handleNotifyAndRedirect('success','Edit Banner successfully',$request,'/admin/banner');
        } catch (\Throwable $th) { 
            return $this->commonFunction->handleNotifyAndRedirect2('error','Edit banner fail',$request);
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner,Request $request)
    {

        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        try {
            $banner->delete();
            return $this->commonFunction->handleNotifyAndRedirect3('success','Delete Banner successfully',$request);
        } catch (\Throwable $th) {
            return $this->commonFunction->handleNotifyAndRedirect3('error','Delete banner fail',$request);
        }   
    }


    public function trash(){
       
        $data=Banner::onlyTrashed()->paginate(5);
        
        return view('admin.views.banner.trash',compact('data'));
    }
    // public function show(){
       
    //     $data=Banner::onlyTrashed()->paginate(5);
        
    //     return view('admin.views.banner.trash',compact('data'));
    // }

    public function restore($id,Request $request){
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        Banner::where('id',$id)->restore();
        
        return $this->commonFunction->handleNotifyAndRedirect('success','Restore Banner successfully',$request,'/admin/banner');
    }

    public function forcedelete($id,Request $request){
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        Banner::where('id',$id)->forceDelete();
        return $this->commonFunction->handleNotifyAndRedirect2('success','Force delete Banner successfully',$request);
    }
}
