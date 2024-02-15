<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Http\Requests\category\UpdateCategoryRequest;
use App\Http\Requests\category\AddCategoryRequest;
use App\Exports\ExportCategory;
use Excel;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
     protected $commonFunction;
     protected $modelFunction;
    public function index(Request $request)
    {
        if($request->keyword){
            $data= Category::where('name','LIKE',"%$request->keyword%")->orwhere('id','LIKE',"%$request->keyword%")->paginate(5);
            $data->appends(['keyword' => $request->keyword]);
        }
        else{
            $data =Category::orderBy('updated_at', 'DESC')->paginate(5);
        }
        return view('admin.views.category.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $data=Category::all();
        return view('admin.views.category.add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCategoryRequest $request)
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
            Category::create($request->all());
            return $this->commonFunction->handleNotifyAndRedirect('success','Add Category successfully',$request,'/admin/category');
        } catch (\Throwable $th) { 
            return $this->commonFunction->handleNotifyAndRedirect2('error','Add category fail',$request);
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
    public function edit(Category $category)
    {
        $data=Category::all();
        return view('admin.views.category.edit',compact('data','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
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
            $category->update($request->all());
            return $this->commonFunction->handleNotifyAndRedirect('success','Update Category successfully',$request,'/admin/category');
        } catch (\Throwable $th) { 
            return $this->commonFunction->handleNotifyAndRedirect2('error','Update category fail',$request);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category,Request $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        try {
            $category->delete();
            return $this->commonFunction->handleNotifyAndRedirect3('success','Delete Category successfully',$request,'/admin/category');
        } catch (\Throwable $th) {
            return $this->commonFunction->handleNotifyAndRedirect3('error','Delete Category fail',$request);
        }   
    }

    public function trash(){
       
        $category=Category::onlyTrashed()->paginate(5);
        return view('admin.views.category.trash',compact('category'));
    }

    public function restore($id,Request $request){
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        Category::where('id',$id)->restore();
        
        return $this->commonFunction->handleNotifyAndRedirect('success','Restore Category successfully',$request,'/admin/category');
    }

    public function forcedelete($id,Request $request){
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        Category::where('id',$id)->forceDelete();
        try {

            return $this->commonFunction->handleNotifyAndRedirect2('success','Force delete Category successfully',$request);
        } catch (\Throwable $th) {
            return $this->commonFunction->handleNotifyAndRedirect3('error','Force delete Category fail',$request);
        } 
       
    }
    public function export() {
        return Excel::download(new ExportCategory,'category.xlsx');
    }
}
