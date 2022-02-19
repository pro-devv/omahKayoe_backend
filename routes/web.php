<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AboutVillageController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryBlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListBlogController;
use App\Http\Controllers\ListKontakController;
use App\Http\Controllers\ListProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\UserController;
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


// Frontend Controller
Route::get('/', [HomeController::class,'index'])->name('beranda');
Route::get('tentang-desa', [AboutController::class,'index'])->name('tentang-kami');
Route::get('list-produk', [ListProductController::class,'index'])->name('produk');
Route::get('produk-detail/{id}', [ListProductController::class,'detail'])->name('produk-detail');
Route::post('produk-detail', [ListProductController::class,'store'])->name('store-produk-detail');
Route::get('blog', [ListBlogController::class,'index'])->name('blog');
Route::get('kontak', [ListKontakController::class,'index'])->name('kontak');

// Backend Controller
Route::middleware(['auth','role:super-admin|admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::prefix('dashboard/')->group(function () {
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
        // add user
        Route::resource('user', UserController::class);
        // edit user
        Route::get('edit-profil/{id}',[ProfilController::class,'EditProfil'])->name('edit.profil');
        Route::post('edit-profil',[ProfilController::class,'EditProfilInsert'])->name('edit.profil.insert');
        // lupa password
        Route::post('lupa-password',[ProfilController::class,'LupaPassword'])->name('lupa.password');
        // about village
        route::resource('about', AboutVillageController::class);
    });

});

require __DIR__.'/auth.php';
