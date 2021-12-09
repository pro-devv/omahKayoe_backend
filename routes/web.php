<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryBlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UlasanController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['role:super-admin|admin'])->name('dashboard');

Route::middleware(['auth','role:super-admin|admin'])->group(function () {
    // Dashboard
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    // banner
    Route::resource('banner', BannerController::class);
    // product
    Route::resource('product', ProductController::class);
    // Category-product
    Route::resource('category-product', CategoryController::class);
    // ulasan
    Route::get('rating', [UlasanController::class, 'index'])->name('rating');
    // blog
    Route::resource('blog', BlogController::class);
    // category-blog
    Route::resource('category-blog', CategoryBlogController::class);
    // transaksi
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi');

});

require __DIR__.'/auth.php';
