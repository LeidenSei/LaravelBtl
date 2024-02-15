<?php

namespace App\Http\CommonFunction;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModelFunction
{
    function addOrUpdateModel($model,Request $request){
        if($request->has('image')){
            $image = $request->file('image');
            $imageName = Str::uuid().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('manager/img'),$imageName);
            $model->image = $imageName;
        }
        if ($request->has('name'))
            $request['name'] = Str::ucfirst($request->get('name'));
        if ($request->has('status'))
            $request['status'] = 1;
        else
            $request['status'] = 0;
        $model->fill($request->all());
        $model->save();
    }
    function deleteModelById($model,$id){
        $model::destroy($id);
    }
}
