<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use DB;
use Carbon;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
class AdminOrderController extends Controller
{
    protected $commonFunction;
    protected $modelFunction;
    public function index() {
        $order=Order::orderBy('updated_at', 'DESC')->paginate(5);
        $order_detail=OrderDetail::all();
        return view('admin.views.order.index',compact('order','order_detail'));
    }
    public function edit($id)  {
        $order=Order::find($id);
       
        return view('admin.views.order.edit',compact('order'));
    }
    public function update(Request $request,$id){
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        try {
            $order=Order::find($id)->update($request->all());
            return $this->commonFunction->handleNotifyAndRedirect('success','Change status successfully',$request,'/admin/order');

        } catch (\Throwable $th) {
            return $this->commonFunction->handleNotifyAndRedirect2('error','Edit order fail',$request);
        }
    }
    public function find(Request $request) {
        if($request->date_from==''){
            $request->date_from=Carbon\Carbon::now()->subday(15);
        }
        if($request->date_to==''){
            $request->date_to= Carbon\Carbon::now();
        }
        $order=Order::whereBetween('created_at',[$request->date_from,$request->date_to])->orderBy('updated_at', 'DESC')->paginate(5);
        return view('admin.views.order.index',compact('order'));
    }
    public function detail($id)  {
        $detail=OrderDetail::where('order_id',$id)->paginate(5);
        return view('admin.views.order.detail',compact('detail'));
    }
}
