<?php

use Illuminate\Support\Facades\{
    Auth,
    Route
};

// User Routes
use App\Http\Controllers\{
    CartController,
    HomeController,
    ReviewController,
    AddressController,
    ProfileController,
    UserOrderController,
    ChangePasswordController,
    WishlistController
};

// Admin Routes
use App\Http\Controllers\admin\{
    PageController,
    UserController,
    BrandController,
    OrderController,
    ProductController,
    ProductImageController,
    CategoryController,
    OrderStatusController,
    CarouselController
};

use App\Http\Controllers\Auth\LoginController;

/*
    Resources:

    - Installing Bootstrap auth template: https://www.tutsmake.com/laravel-8-bootstrap-auth-scaffolding-example/
    - Laravel 8 Multi Auth: https://www.itsolutionstuff.com/post/laravel-8-multi-auth-authentication-tutorialexample.html
    - Search: https://dev.to/kingsconsult/how-to-implement-search-functionality-in-laravel-8-and-laravel-7-downwards-3g76
    - Add to cart: https://larainfo.com/blogs/laravel-8-add-to-cart-step-by-step-example
    - Dropdown filter: https://www.itsolutionstuff.com/post/laravel-datatables-filter-with-dropdown-exampleexample.html
    - Shopping cart template: https://www.bootdey.com/snippets/view/shop-cart#html
    - Product list template: https://www.bootdey.com/snippets/view/Shop-product-list#html
    - User profile template 1: https://www.bootdey.com/snippets/view/profile-edit-settings
    - User profile template 2: https://bbbootstrap.com/snippets/bootstrap-edit-profile-accounts-setting-template-80240656
    - Product filter: https://www.codecheef.org/article/advanced-search-filter-using-dropdown-in-laravel
    - Username validation: https://panjeh.medium.com/laravel-validation-username-no-space-allowed-alpha-dash-or-regex-custom-rule-6399cf508722
    - Regex validation: https://stackoverflow.com/questions/42577045/laravel-5-4-validation-with-regex
    - Data Daerah API: https://farizdotid.com/blog/dokumentasi-api-daerah-indonesia/, https://github.com/farizdotid/DAFTAR-API-LOKAL-INDONESIA
    - SweetAlert delete confirmation: https://stackoverflow.com/questions/40579520/delete-method-with-sweet-alert-in-laravel
    - CSS Box Shadow Generator: https://cssgenerator.org/box-shadow-css-generator.html
    - Change Bootstrap Pagination color: https://stackoverflow.com/questions/28864718/how-to-change-the-color-of-the-stock-pagination-that-come-with-laravel
    - Laravel Change Password: https://www.itsolutionstuff.com/post/laravel-change-password-with-current-password-validation-exampleexample.html
    - How to create component: https://www.indeveloper.id/2020/03/tutorial-cara-membuat-dan-menggunakan.html
    - Bootstrap Datepicker: https://bootstrap-datepicker.readthedocs.io/en/stable/
    - Multiple image upload: https://medium.com/dot-intern/create-multiple-upload-images-laravel-plus-displaying-on-view-6074aca289d
    - Check user status: https://www.nicesnippets.com/blog/how-to-check-user-online-status-last-seen-in-laravel
    - Laravel dynamic carousel: https://www.codegrepper.com/code-examples/php/create+a+slider+carousel+laravel
    - Add commas to numbers while typing without decimals: https://codepen.io/kdivya/pen/oxVeWz
    - Google Login / Register: https://www.sahretech.com/2021/04/cara-membuat-fitur-login-google-di.html, https://jaranguda.com/tutorial-google-authentication-dengan-laravel-6/
    - Laravel wishlist: https://github.com/lamalamaNL/laravel-wishlist
*/

// Page Route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/product', [HomeController::class, 'product'])->name('product');
Route::get('/product/{slug}', [HomeController::class, 'showProduct'])->name('show_product');

// Google Login Route
Route::get('/auth/redirect', [LoginController::class, 'redirectToProvider']);
Route::get('/auth/callback', [LoginController::class, 'handleProviderCallback']);

Route::group(['middleware' => ['auth']], function () {
    // Cart Route
    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/', [CartController::class, 'store'])->name('store');
        Route::patch('/{id}', [CartController::class, 'update'])->name('update');
        Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
        Route::delete('/{id}', [CartController::class, 'destroy'])->name('destroy');
    });
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

    // Wishlist Route
    Route::group(['prefix' => 'wishlist', 'as' => 'wishlist.'], function () {
        Route::get('/', [WishlistController::class, 'index'])->name('index');
        Route::post('/', [WishlistController::class, 'store'])->name('store');
        Route::delete('/', [WishlistController::class, 'destroy'])->name('destroy');
        Route::delete('/clear', [WishlistController::class, 'clear'])->name('clear');
    });

    // Review Route
    Route::group(['prefix' => 'review', 'as' => 'review.'], function () {
        Route::post('/', [ReviewController::class, 'store'])->name('store');
        Route::delete('/{id}', [ReviewController::class, 'destroy'])->name('destroy');
    });

    // Profile Route
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::patch('/{profile}', [ProfileController::class, 'update'])->name('update');
    });

    // Address Route
    Route::group(['prefix' => 'address', 'as' => 'address.'], function () {
        Route::get('/', [AddressController::class, 'index'])->name('index');
        Route::get('/create', [AddressController::class, 'create'])->name('create');
        Route::post('/', [AddressController::class, 'store'])->name('store');
        Route::patch('/{address}', [AddressController::class, 'update'])->name('update');
    });
    Route::get('getCity/ajax/{id}', [AddressController::class, 'ajax']);
    Route::get('getCity/ajax2/{id}', [AddressController::class, 'ajax2']);

    // User Order Route
    Route::group(['prefix' => 'order', 'as' => 'user_order.'], function () {
        Route::get('/', [UserOrderController::class, 'index'])->name('index');
        Route::post('/', [UserOrderController::class, 'store'])->name('store');
    });

    // Change Password Route
    Route::group(['middleware' => 'is_google', 'prefix' => 'change-password', 'as' => 'change-password.'], function () {
        Route::get('/', [ChangePasswordController::class, 'index'])->name('index');
        Route::post('/', [ChangePasswordController::class, 'store'])->name('store');
    });
});

// Admin Route
Auth::routes();
Route::group([
    'prefix' => 'admin',
    'middleware' => ['is_admin', 'auth']
], function () {
    Route::get('home', [PageController::class, 'index'])->name('admin.home');

    // Carousel Route
    Route::group(['prefix' => 'carousel', 'as' => 'carousel.'], function () {
        Route::get('/', [CarouselController::class, 'index'])->name('index');
        Route::get('/create', [CarouselController::class, 'create'])->name('create');
        Route::post('/', [CarouselController::class, 'store'])->name('store');
        Route::get('/{carousel}/edit', [CarouselController::class, 'edit'])->name('edit');
        Route::patch('/{carousel}', [CarouselController::class, 'update'])->name('update');
        Route::delete('/{carousel}', [CarouselController::class, 'destroy'])->name('destroy');
    });

    // Brand Route
    Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::get('/create', [BrandController::class, 'create'])->name('create');
        Route::post('/', [BrandController::class, 'store'])->name('store');
        Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('edit');
        Route::patch('/{brand}', [BrandController::class, 'update'])->name('update');
        Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('destroy');
    });

    // Category Route
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    // Product Route
    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}', [ProductController::class, 'show'])->name('show');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::patch('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // Product Image Route
    Route::group(['prefix' => 'product', 'as' => 'product_image.'], function () {
        Route::get('/{slug}/images', [ProductImageController::class, 'index'])->name('index');
        Route::get('/{slug}/images/create', [ProductImageController::class, 'create'])->name('create');
        Route::post('/{slug}/images', [ProductImageController::class, 'store'])->name('store');
        Route::delete('/images/{id}', [ProductImageController::class, 'destroy'])->name('destroy');
    });

    // Order Route
    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::patch('/{order}', [OrderController::class, 'update'])->name('update');
    });

    // Order Status Route
    Route::group(['prefix' => 'order_status', 'as' => 'order_status.'], function () {
        Route::get('/', [OrderStatusController::class, 'index'])->name('index');
        Route::get('/create', [OrderStatusController::class, 'create'])->name('create');
        Route::post('/', [OrderStatusController::class, 'store'])->name('store');
        Route::get('/{order_status}/edit', [OrderStatusController::class, 'edit'])->name('edit');
        Route::patch('/{order_status}', [OrderStatusController::class, 'update'])->name('update');
        Route::delete('/{order_status}', [OrderStatusController::class, 'destroy'])->name('destroy');
    });

    // User Route
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
    });
});
