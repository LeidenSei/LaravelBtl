<?php

namespace App\Http\CommonFunction;

use App\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Banner;
class CommonFunction
{
    function handleNotifyAndRedirect($alertType,$message,Request $request,$redirectRoute){
        $request->session()->flash('message',$message);
        $request->session()->flash('alert-type',$alertType);
        return redirect($redirectRoute);
    }

    function handleNotifyAndRedirect2($alertType,$message,Request $request){
        $request->session()->flash('message',$message);
        $request->session()->flash('alert-type',$alertType);
        return redirect()->back();
    }

    function handleNotifyAndRedirect3($alertType,$message,Request $request){
        $request->session()->flash('message',$message);
        $request->session()->flash('alert-type',$alertType);
        return redirect()->back();
    }
    function isValueExist($keyCheckExist,$valueCheckExist,$modelName, $excludeId = null)
    {
        $query = $modelName::where($keyCheckExist, $valueCheckExist);
        if (!is_null($excludeId)) {
            $query->where('id', '!=', $excludeId);
        }
        return $query->exists();
    }
}
