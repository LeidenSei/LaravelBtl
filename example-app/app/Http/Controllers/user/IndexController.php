<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class IndexController extends Controller
{
    public function index() {
        $cate=Category::all();
        return view('fe.index');
    }
}
