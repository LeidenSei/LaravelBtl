<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
class AdminAuthenticate
{
    protected $commonFunction;
    protected $modelFunction;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        if(Auth::check() && Auth::user()->role==1){
            return $next($request);
        }
        
        return $this->commonFunction->handleNotifyAndRedirect('error','You need to logon to continue',$request,'/logon');
         
        
    }
}
