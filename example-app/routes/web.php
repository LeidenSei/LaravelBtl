<?php

use App\AcademicLevel;
use App\Http\Controllers\manager\AcademicLevelController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserControllerAdmin;
use App\Http\Controllers\admin\AdminOrderController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\IndexController;
use App\Http\Controllers\user\DashBoardController;
use App\Http\Controllers\user\OrderUserController;
use App\Rating;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\manager\LayoutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('manager/views/index');
//});

//  Route::get('/admin', [LayoutController::class, 'index'])->name('admin.index');
// Route::get('/logon', [LoginController::class, 'login'])->name('logon');
// Route::post('/logon/post', [LoginController::class, 'post'])->name('logon.post');
// ::middleware('admin')

Route::get('/logon', [AdminController::class, 'logon'])->name('logon');
Route::post('/logon', [AdminController::class, 'postlogon']);
Route::get('/logoutadmin', [AdminController::class, 'adminlogout'])->name('admin.logout');
// Route::post('/logon', [AdminController::class, 'postlogon']);
// ->middleware('admin')
Route::prefix('/admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('banner', BannerController::class)->except('show');
    Route::get('banner/trash', [BannerController::class,'trash'])->name('banner.trash');
    Route::get('/banner/find', [BannerController::class, 'find'])->name('banner.find');
    Route::post('banner/export', [BannerController::class, 'index'])->name('banner.export');
    Route::get('/banner/{id}/restore', [BannerController::class,'restore'])->name('banner.restore');
    Route::get('/banner/{id}/forcedelete', [BannerController::class,'forcedelete'])->name('banner.forcedelete');
    //category
    Route::resource('category', CategoryController::class)->except('show');
    Route::get('category/trash', [CategoryController::class,'trash'])->name('category.trash');
    Route::get('/category/{id}/restore', [CategoryController::class,'restore'])->name('category.restore');
    Route::get('/category/{id}/forcedelete', [CategoryController::class,'forcedelete'])->name('category.forcedelete');
    Route::get('/category/export', [CategoryController::class,'export'])->name('category.export');
    //product
    Route::resource('product', ProductController::class)->except('show');
    Route::get('product/trash', [ProductController::class,'trash'])->name('product.trash');
    Route::get('/product/{id}/restore', [ProductController::class,'restore'])->name('product.restore');
    Route::get('/product/{id}/forcedelete', [ProductController::class,'forcedelete'])->name('product.forcedelete');
    Route::get('/product/export', [ProductController::class,'export'])->name('export');
    //User
    Route::resource('user', UserControllerAdmin::class)->except('show');
    Route::get('user/trash', [UserControllerAdmin::class,'trash'])->name('user.trash');
    //
    Route::resource('order', AdminOrderController::class)->except('show');
    Route::get('/order/find', [AdminOrderController::class, 'find'])->name('order.find');
    Route::get('/order/detail/{id}', [AdminOrderController::class, 'detail'])->name('order.detail');
    //Blog
    Route::resource('blog', BlogController::class)->except('show');
    Route::get('blog/trash', [BlogController::class,'trash'])->name('blog.trash');
    Route::get('/blog/{id}/restore', [BlogController::class,'restore'])->name('blog.restore');
    Route::get('/blog/{id}/forcedelete', [BlogController::class,'forcedelete'])->name('blog.forcedelete');



});
//fe
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/login', [UserController::class, 'postLogin'])->name('user.postLogin');
Route::get('/register', [UserController::class, 'register'])->name('user.register');
Route::post('/register', [UserController::class, 'postRegister'])->name('post.register');

Route::get('/detail/{slug}', [HomeController::class, 'detail'])->name('detail');
Route::post('/detail/review', [HomeController::class, 'review'])->name('product.review');
Route::get('/blog', [UserController::class, 'blog'])->name('blog');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/detailBlog/{slug}', [UserController::class, 'detalBlog'])->name('blog.detail');


Route::middleware(['user'])->group(function () {
Route::get('/dashboard/{id}', [DashBoardController::class, 'index'])->name('dashboard');
Route::get('/logoutDashboard', [DashBoardController::class, 'logoutDashboard'])->name('logoutDashboard');
Route::put('/dashboard/{id}', [DashBoardController::class, 'index'])->name('dashboard');
Route::post('/change-password/{id}',[DashBoardController::class, 'changePassword'])->name('changePassword');
Route::post('/update-userProfile/{id}',[DashBoardController::class, 'updateprofile'])->name('updateProfile');
Route::get('/order-detail/{id}',[DashBoardController::class, 'orderDetail'])->name('orderDetail');
Route::get('/cancelOrder/{id}',[DashBoardController::class, 'cancelOrder'])->name('cancelOrder');
Route::get('/deleteOrder/{id}',[DashBoardController::class, 'deleteOrder'])->name('deleteOrder');
Route::get('/RestoreOrder/{id}',[DashBoardController::class, 'RestoreOrder'])->name('RestoreOrder');
Route::get('/wishlist', [UserController::class, 'wishlist'])->name('user.wishlist');
Route::post('/wishlist-post', [UserController::class, 'postWishList'])->name('user.wishlist_post');
Route::post('/removeWish', [UserController::class, 'removeWish'])->name('user.removeWish');
});



Route::get('/shop', [HomeController::class, 'shopByCate'])->name('shopCate');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-cart', [CartController::class, 'add'])->name('cart.add');
Route::get('remove-item-cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('cart/clear', [CartController::class, 'clear'])->name('cart.clear');


//checkout
Route::get('/checkout', [OrderUserController::class, 'checkout'])->name('checkout');
Route::post('/post-checkout', [OrderUserController::class, 'postcheckout'])->name('post.checkout');
Route::get('/checkout-success',[OrderUserController::class, 'success'])->name('checkout.success');

//test
// Route::get('test-email', [HomeController::class, 'test']);

//forgot pass
Route::get('forget-password', [UserController::class, 'forgot'])->name('user.forgot');
Route::post('forget-password', [UserController::class, 'post_forgot']);
Route::get('get-password/{user}/{token}', [UserController::class, 'getPass'])->name('user.getPass');
Route::post('get-password/{user}/{token}', [UserController::class, 'postGetPass']);

