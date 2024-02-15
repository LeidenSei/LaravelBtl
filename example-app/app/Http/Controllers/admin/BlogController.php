<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Models\Blog;
use App\Http\Requests\blog\AddBlogRequest;
use App\Http\Requests\blog\EditBlogRequest;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $commonFunction;
    protected $modelFunction;
    public function index(Request $request)
    {
        if($request->keyword){
            $blog= Blog::where('name','LIKE',"%$request->keyword%")->orwhere('id','LIKE',"%$request->keyword%")->paginate(5);
            $blog->appends(['keyword' => $request->keyword]);
        }
        else{
            $blog=Blog::orderBy('updated_at', 'DESC')->paginate(5);
        }
        
        return view('admin.views.blog.index',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.views.blog.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddBlogRequest $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $file_name=$request->photo->getClientOriginalName();
        $request->photo->storeAs('public/images',$file_name);
        $request->merge(['image'=>$file_name]); 
        try {       
            Blog::create($request->all());
            return $this->commonFunction->handleNotifyAndRedirect('success','Add Blog successfully',$request,'/admin/blog');
        } catch (\Throwable $th) { 
            return $this->commonFunction->handleNotifyAndRedirect2('error','Add blog fail',$request);
        } 
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
    public function edit(Blog $blog)
    {

        return view('admin.views.blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditBlogRequest $request,  Blog $blog)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        
        if(!$request->photo==''){
            $file_name=$request->photo->getClientOriginalName();
            $request->photo->storeAs('public/images',$file_name);
            $request->merge(['image'=>$file_name]);  
        }
        try {       
            $blog->update($request->all());
            return $this->commonFunction->handleNotifyAndRedirect('success','Edit Blog successfully',$request,'/admin/blog');
        } catch (\Throwable $th) { 
            return $this->commonFunction->handleNotifyAndRedirect2('error','Edit blog fail',$request);
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog,Request $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        try {
            $blog->delete();
            return $this->commonFunction->handleNotifyAndRedirect3('success','Delete Blog successfully',$request,'/admin/blog');
        } catch (\Throwable $th) {
            return $this->commonFunction->handleNotifyAndRedirect3('error','Delete Blog fail',$request);
        } 
    }
    public function trash(){
       
        $blog=Blog::onlyTrashed()->paginate(5);
        
        return view('admin.views.blog.trash',compact('blog'));
    }

    public function restore($id,Request $request){
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        Blog::where('id',$id)->restore();
        return $this->commonFunction->handleNotifyAndRedirect('success','Restore Blog successfully',$request,'/admin/blog');
    }
    public function forcedelete($id,Request $request){
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        Blog::where('id',$id)->forceDelete();
        return $this->commonFunction->handleNotifyAndRedirect2('success','Force delete Blog successfully',$request);
    }
}
