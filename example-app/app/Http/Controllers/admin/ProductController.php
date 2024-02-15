<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Models\Product;
use App\Models\Category;
use App\Models\ImgProduct;
use App\Exports\ExportProduct;
use  App\Http\Requests\product\AddProductRequest;
use  App\Http\Requests\product\UpdateProductRequest;
use Excel;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $commonFunction;
    protected $modelFunction;
    public function index(Request $request)
    {
        $cate=Category::all();
        if($request->keyword){
            $data= Product::where('name','LIKE',"%$request->keyword%")
            ->orwhere('id','LIKE',"%$request->keyword%")
            ->orwhere('price','LIKE',"%$request->keyword%")
            ->orwhere('sale_price','LIKE',"%$request->keyword%")
            ->orderBy('updated_at', 'DESC')
            ->paginate(5);
            $data->appends(['keyword' => $request->keyword]);
        }
        else{
            $data =Product::orderBy('updated_at', 'DESC')->paginate(5);
        }
        return view('admin.views.product.index',compact('data','cate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=Category::all();
        return view('admin.views.product.add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request)
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
        if ($request->has('stock')){
            $request['stock'] = 1;
        } else {
            $request['stock'] = 0;
        }  
        try {
            $product=Product::create($request->all());
            if($product && $request->hasFile('photos')){
                foreach ($request->photos as $key => $value) {
                    $file_names=$value->getClientOriginalName();
                    $value->storeAs('public/images',$file_names);
                    ImgProduct::create([
                        'product_id'=>$product->id,
                        'image'=>$file_names
                    ]);
                }
            }
            return $this->commonFunction->handleNotifyAndRedirect('success','Add Product successfully',$request,'/admin/product');
        } catch (\Throwable $th) {
            
            return $this->commonFunction->handleNotifyAndRedirect2('error','Add Product fail',$request);
        }
    }


    public function edit(Product $product)
    {
        $data=Category::all();
        return view('admin.views.product.edit',compact('data','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
       
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $file_name='';
        
        if(!$request->photo==''){
            $file_name=$request->photo->getClientOriginalName();
            $request->photo->storeAs('public/images',$file_name);
            $request->merge(['image'=>$file_name]);
        }
        if ($request->has('status')){
            $request['status'] = 1;
        } else {
            $request['status'] = 0;
        }

        if ($request->has('stock')){
            $request['stock'] = 1;
        } else {
            $request['stock'] = 0;
        }
        try {
            $product->update($request->all());  
            if($product && $request->hasFile('photos')){   
                ImgProduct::where('product_id',$product->id)->delete();         
                foreach ($request->photos as  $value) {
                    $file_names=$value->getClientOriginalName();
                    $value->storeAs('public/images',$file_names);                   
                    ImgProduct::create([
                        'product_id'=>$product->id,
                        'image'=>$file_names
                    ]);
                }
                
            } 
            return $this->commonFunction->handleNotifyAndRedirect('success','Update Product successfully',$request,'/admin/product');
        } catch (\Throwable $th) {
            dd($th);
            return $this->commonFunction->handleNotifyAndRedirect2('error','Update Product fail',$request);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product,Request $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $product->delete();
        try {
            $product->delete();
            return $this->commonFunction->handleNotifyAndRedirect3('success','Delete Product successfully',$request,'/admin/product');
        } catch (\Throwable $th) {
            return $this->commonFunction->handleNotifyAndRedirect3('error','Delete Product fail',$request);
        }  
    }
    public function trash(){
        $product=Product::onlyTrashed()->paginate(5);
        return view('admin.views.product.trash',compact('product'));
    }

    public function restore($id,Request $request){
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        Product::where('id',$id)->restore();
        return $this->commonFunction->handleNotifyAndRedirect('success','Restore Category successfully',$request,'/admin/product');
    }
    public function forcedelete($id,Request $request){
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        ImgProduct::where('product_id',$id)->delete();
        Product::where('id',$id)->forceDelete();    
        return $this->commonFunction->handleNotifyAndRedirect2('success','Force delete Product successfully',$request);
    }
    public function export()  {
        return Excel::download(new ExportProduct,'product.xlsx');
    }


}
