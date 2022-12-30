<?php

use App\Http\Controllers\ActivateVendorAccountController;
use App\Http\Controllers\Admin\AdminSetting\AdminLoginController;
use App\Http\Controllers\Admin\AdminSetting\CheckPasswordController;
use App\Http\Controllers\Admin\AdminSetting\UpdateDetailController;
use App\Http\Controllers\Admin\AdminSetting\UpdatePasswordController;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Admin\Brand\BrandController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Filter\FilterController;
use App\Http\Controllers\Admin\Filter\FilterValueController;
use App\Http\Controllers\Admin\Product\Attachment\AttachmentController;
use App\Http\Controllers\Admin\Product\Attachment\DeleteAllAttachmentController;
use App\Http\Controllers\Admin\Product\Attachment\DownloadAttachmentController;
use App\Http\Controllers\Admin\Product\Attribute\AttributeController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Section\SectionController;
use App\Http\Controllers\Admin\Supervisor\AdminController;
use App\Http\Controllers\Admin\Coupon\CouponController;
use App\Http\Controllers\Vendor\UpdateVendorBankController;
use App\Http\Controllers\Vendor\UpdateVendorBusinessController;
use App\Http\Controllers\Vendor\UpdateVendorDetailController;
use App\Http\Livewire\Front\Cart\ShoppingCartPage;
use App\Http\Livewire\Front\Checkout\AddDelieveryAddress;
use App\Http\Livewire\Front\Checkout\CheckoutPage;
use App\Http\Livewire\Front\Checkout\EditDelieveryAddress;
use App\Http\Livewire\Front\Customer\ProfilePage;
use App\Http\Livewire\Front\Detail\ProductDetailPage;
use App\Http\Livewire\Front\Home\HomePage;
use App\Http\Livewire\Front\Shop\CategoryProducts;
use App\Http\Livewire\Front\Shop\ShopPage;
use App\Http\Livewire\Front\Vendor\RegisterPage;
use App\Http\Livewire\Front\Vendor\VendorProducts;
use App\Http\Livewire\Front\Wishlist\WishlistPage;
use Illuminate\Support\Facades\Route;

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

require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');







Route::prefix('admin/')->name('admin.')->group(function () {
    Route::get('login-form',                                        [AdminLoginController::class, 'loginForm'])->name('login.form');
    Route::post('login',                                            [AdminLoginController::class, 'login'])->name('login');

    Route::group(['middleware' => 'admin'], function () {

        Route::get('dashboard',                                     [AdminLoginController::class, 'index'])->name('dashboard');
        Route::get('logout',                                        [AdminLoginController::class, 'logout'])->name('logout');

        Route::view('profile',                                      'admin.profile')->name('profile');
        Route::post('check-password',                               CheckPasswordController::class)->name('check_password');
        Route::put('update-details',                                UpdateDetailController::class)->name('update_details');
        Route::put('update-password',                               UpdatePasswordController::class)->name('update_password');


        //?_________________________
        //? Admins
        //?_________________________
        Route::resource('admins',                                   AdminController::class);


        //?_________________________
        //? Sections
        //?_________________________
        Route::resource('sections',                                 SectionController::class);


        //?_________________________
        //? Categories
        //?_________________________
        Route::resource('categories',                               CategoryController::class);


        //?_________________________
        //? Brands
        //?_________________________
        Route::resource('brands',                                   BrandController::class);


        //?_________________________
        //? Products
        //?_________________________
        Route::resource('products',                                 ProductController::class);

        //?_________________________
        //? Products Filters
        //?_________________________
        Route::resource('filters',                                  FilterController::class);

        //?_________________________
        //? Products Filters
        //?_________________________
        Route::resource('filters-values',                           FilterValueController::class);

        //?_________________________
        //? Products Attributes
        //?_________________________
        Route::resource('products.attributes',                      AttributeController::class)->only(['create', 'store']);
        Route::put('products/{product}/attributes',                 [AttributeController::class, 'update'])->name('products.attributes.update');

        //?_________________________
        //? Products Attributes
        //?_________________________
        Route::resource('products.attachments',                     AttachmentController::class)->only(['create', 'store']);
        Route::get('attachment/{attachment}/destroy',               [AttachmentController::class, 'destroy'])->name('products.attachments.destroy');
        Route::get('attachment/{attachment}/download',              DownloadAttachmentController::class)->name('products.attachments.download');
        Route::get('attachment/{attachment}/delete-all',            DeleteAllAttachmentController::class)->name('products.attachments.deleteAll');


        //?_________________________
        //? Banners
        //?_________________________
        Route::resource('banners',                                  BannerController::class);


        //?_________________________
        //? Coupons
        //?_________________________
        Route::resource('coupons',                                  CouponController::class);
    });
});

Route::prefix('vendor/')->name('vendor.')->group(function () {

    Route::get('register',                                  RegisterPage::class)->name('register');

    Route::get('activate-account/{code}',                   ActivateVendorAccountController::class)->name('activate.account');

    Route::get('login-form',                                [AdminLoginController::class, 'loginForm'])->name('login.form');

    Route::view('profile',                                  'admin.vendors.profile')->name('profile');

    Route::put('update-details',                            UpdateVendorDetailController::class)->name('peronsal-info.update');

    Route::put('update-business',                           UpdateVendorBusinessController::class)->name('business-info.update');

    Route::put('update-bank',                               UpdateVendorBankController::class)->name('bank-info.update');

    Route::get('/{vendor_id}/products',                     VendorProducts::class)->name('products');
});

Route::name('front.')->group(function () {

    Route::get('/',                                         HomePage::class)->name('home');

    Route::get('/shop',                                     ShopPage::class)->name('shopping.store');

    Route::get('/shop/{url}',                               CategoryProducts::class)->name('shop.category.products');

    Route::get('/product/{productId}',                      ProductDetailPage::class)->name('product.detail');

    Route::get('/shopping-cart',                            ShoppingCartPage::class)->name('shopping.cart');

    Route::get('/checkout',                                 CheckoutPage::class)->name('checkout');
    Route::get('/delivery-addresses/add',                   AddDelieveryAddress::class)->name('delivery.addresses.add');
    Route::get('/delivery-addresses/edit/{id}',             EditDelieveryAddress::class)->name('delivery.addresses.edit');

    Route::get('/wishlist',                                 WishlistPage::class)->name('wishlist');

    Route::get('/profile',                                  ProfilePage::class)->name('profile');
});



Route::get('/{page}', [App\Http\Controllers\AdminController::class, 'index']);