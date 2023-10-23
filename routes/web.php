<?php

use App\Models\TopSidebar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\CartController;

use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;


use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SidebarController;
use App\Http\Controllers\Backend\BookTypeController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
// use Laravel\Fortify\Http\Controllers\NewPasswordController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\NewPasswordController;
use App\Http\Controllers\Backend\PublicationController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\Product_UnitController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Frontend\ProductPageController;
use App\Http\Controllers\Backend\CategorySliderController;
use App\Http\Controllers\Backend\PasswordResetLinkController;
use App\Http\Controllers\Backend\TopSidebarMenuSliderController;
use App\Http\Controllers\User\UserController as UserUserController;

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

// Adnan 

// Route::get('/', function () {
//     return view('welcome');
// });

// Admin Login Routes Start
Route::middleware('admin:admin')->group(function () {
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');

    // Captcha add Route Start
    Route::get('/reload-captcha', [CaptchaController::class, 'ReloadCaptcha'])->name('reload.captcha');
    // Captcha add Route End

    // Admin password forgot Route Start
    Route::get('admin/forgot-password', [PasswordResetLinkController::class, 'create'])->name('admin.password.request');
    Route::post('admin/forgot-password', [PasswordResetLinkController::class, 'store'])->name('admin.password.email');
    Route::get('admin/reset-password/{token}', [NewPasswordController::class, 'create'])->name('admin.password.reset');
    Route::post('admin/reset-password', [NewPasswordController::class, 'store'])->name('admin.password.update');
    // Admin password forgot Route End
});
// Admin Login Routes End



// Admin Section All Routes Start
Route::middleware(['auth:sanctum,admin', config('jetstream.auth_session'), 'verified' ])->group(function () {
    // Route::get('/admin/dashboard', function () {
    //     return view('admin.index');
    // })->name('dashboard')->middleware('auth:admin');
    
    Route::get('/admin/dashboard', [DashboardController::class, 'AdminDashboard'])->name('dashboard')->middleware('auth:admin');

    // Admin Logout Routes Start 
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    // Admin Logout Routes End 


    // Admin Profile All Route Start
    Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
    // Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::post('/admin/profile/update/{id}', [AdminProfileController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');

    // Admin Profile All Route End


    // Admin Brand All Route Start
    Route::prefix('brand')->group(function() {
        Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
        Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
        Route::post('/update/{id}', [BrandController::class, 'BrandUpdate'])->name('brand.update');
        Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
        Route::get('/inactive/{id}', [BrandController::class, 'BrandInactive'])->name('brand.inactive');
        Route::get('/active/{id}', [BrandController::class, 'BrandActive'])->name('brand.active');
    });
    // Admin Brand All Route End


    // Admin Category All Route Start
    Route::prefix('category')->group(function() {
        Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
        Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
        Route::get('/inactive/{id}', [CategoryController::class, 'CategoryInactive'])->name('category.inactive');
        Route::get('/active/{id}', [CategoryController::class, 'CategoryActive'])->name('category.active');

        // Admin Sub Category All Route Start
        Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');
        Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
        Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
        Route::post('/sub/update/{id}', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
        Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');
        // Admin Sub Category All Route End

        // Admin Sub->Sub Category All Route Start
        Route::get('/sub/sub/view', [SubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');
        Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
        Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);
        Route::post('/sub/sub/store', [SubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
        Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');
        Route::post('/sub/sub/update/{id}', [SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');
        Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');
        // Admin Sub->Sub Category All Route End
    });
    // Admin Category All Route End


    // Admin Author All Route Start
    Route::prefix('author')->group(function() {
        Route::get('/view', [AuthorController::class, 'AuthorView'])->name('all.author');
        Route::get('/add', [AuthorController::class, 'AuthorAdd'])->name('add.author');
        Route::post('/store', [AuthorController::class, 'AuthorStore'])->name('author.store');
        Route::get('/edit/{id}', [AuthorController::class, 'AuthorEdit'])->name('author.edit');
        Route::post('/update/{id}', [AuthorController::class, 'AuthorUpdate'])->name('author.update');
        Route::get('/delete/{id}', [AuthorController::class, 'AuthorDelete'])->name('author.delete');
    });
    // Admin Author All Route End


    // Admin Book_type All Route Start
    Route::prefix('book_type')->group(function() {
        Route::get('/view', [BookTypeController::class, 'BookTypeView'])->name('all.book-type');
        Route::post('/store', [BookTypeController::class, 'BookTypeStore'])->name('book-type.store');
        Route::get('/edit/{id}', [BookTypeController::class, 'BookTypeEdit'])->name('book-type.edit');
        Route::post('/update/{id}', [BookTypeController::class, 'BookTypeUpdate'])->name('book-type.update');
        Route::get('/delete/{id}', [BookTypeController::class, 'BookTypeDelete'])->name('book-type.delete');
    });
    // Admin Book_type All Route End


    // Admin Publication All Route Start
    Route::prefix('publication')->group(function() {
        Route::get('/view', [PublicationController::class, 'PublicationView'])->name('all.publication');
        Route::post('/store', [PublicationController::class, 'PublicationStore'])->name('publication.store');
        Route::get('/edit/{id}', [PublicationController::class, 'PublicationEdit'])->name('publication.edit');
        Route::post('/update/{id}', [PublicationController::class, 'PublicationUpdate'])->name('publication.update');
        Route::get('/delete/{id}', [PublicationController::class, 'PublicationDelete'])->name('publication.delete');
    });
    // Admin Publication All Route End


    // Admin Product_units All Route Start
    Route::prefix('product_units')->group(function() {
        Route::get('/view', [Product_UnitController::class, 'ProductUnitsView'])->name('all.product_units');
        Route::post('/store', [Product_UnitController::class, 'ProductUnitsStore'])->name('product_units.store');
        Route::get('/edit/{id}', [Product_UnitController::class, 'ProductUnitsEdit'])->name('product_units.edit');
        Route::post('/update/{id}', [Product_UnitController::class, 'ProductUnitsUpdate'])->name('product_units.update');
        Route::get('/delete/{id}', [Product_UnitController::class, 'ProductUnitsDelete'])->name('product_units.delete');
    });
    // Admin Product_units All Route End


    // Admin Products All Route Start
    Route::prefix('product')->group(function() {
        Route::get('/details/view/{id}', [ProductController::class, 'DetailsViewProduct'])->name('details-view-product');
        Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');
        Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
        Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
        Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'ProductDataUpdate'])->name('product-update');
        Route::post('/multiimg/add', [ProductController::class, 'MultiImageAdd'])->name('add-product-image');
        Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
        Route::post('/thambnail/update/{id}', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');
        Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
        Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
        Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
        Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
    });
    // Admin Products All Route End


    // Admin Slider All Route Start
    Route::prefix('slider')->group(function() {
        Route::get('/view', [SliderController::class, 'SliderView'])->name('manage-slider');
        Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');
        Route::post('/update/{id}', [SliderController::class, 'SliderUpdate'])->name('slider.update');
        Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
        Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');
        Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');

    });
    // Admin Slider All Route End


    // Admin Category Slider All Route Start
    Route::prefix('category_slider')->group(function() {
        Route::get('/view', [CategorySliderController::class, 'CategorySliderView'])->name('manage.category-slider');
        Route::post('/store', [CategorySliderController::class, 'CategorySliderStore'])->name('category-slider.store');
        Route::get('/edit/{id}', [CategorySliderController::class, 'CategorySliderEdit'])->name('category-slider.edit');
        Route::post('/update/{id}', [CategorySliderController::class, 'CategorySliderUpdate'])->name('category-slider.update');
        Route::get('/delete/{id}', [CategorySliderController::class, 'CategorySliderDelete'])->name('category-slider.delete');
        Route::get('/inactive/{id}', [CategorySliderController::class, 'CategorySliderInactive'])->name('category-slider.inactive');
        Route::get('/active/{id}', [CategorySliderController::class, 'CategorySliderActive'])->name('category-slider.active');

    });
    // Admin Category Slider All Route End


    // Admin Top-Sidebar Menu Slider All Route Start
    Route::prefix('top_sidebar_menu_slider')->group(function() {
        Route::get('/view', [TopSidebarMenuSliderController::class, 'TopSidebarMenuSliderView'])->name('manage.top-sidebar-menu-slider');
        Route::post('/store', [TopSidebarMenuSliderController::class, 'TopSidebarMenuSliderStore'])->name('top-sidebar-menu-slider.store');
        Route::get('/edit/{id}', [TopSidebarMenuSliderController::class, 'TopSidebarMenuSliderEdit'])->name('top-sidebar-menu-slider.edit');
        Route::post('/update/{id}', [TopSidebarMenuSliderController::class, 'TopSidebarMenuSliderUpdate'])->name('top-sidebar-menu-slider.update');
        Route::get('/delete/{id}', [TopSidebarMenuSliderController::class, 'TopSidebarMenuSliderDelete'])->name('top-sidebar-menu-slider.delete');
        Route::get('/inactive/{id}', [TopSidebarMenuSliderController::class, 'TopSidebarMenuSliderInactive'])->name('top-sidebar-menu-slider.inactive');
        Route::get('/active/{id}', [TopSidebarMenuSliderController::class, 'TopSidebarMenuSliderActive'])->name('top-sidebar-menu-slider.active');
    });
    // Admin Top-Sidebar Menu Slider All Route End 


    // Admin Coupons All Route Start
    Route::prefix('coupons')->group(function() {
        Route::get('/view', [CouponController::class, 'CouponView'])->name('manage-coupon');
        Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store');
        Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
        Route::post('/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');
        Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
    });
    // Admin Coupons All Route End 


    // Admin Shipping All Route Start
    Route::prefix('shipping')->group(function() {
        // Ship Division All Route Start
        Route::get('/division/view', [ShippingAreaController::class, 'DivisionView'])->name('manage-division');
        Route::post('/division/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');
        Route::get('/division/edit/{id}', [ShippingAreaController::class, 'DivisionEdit'])->name('division.edit');
        Route::post('/division/update/{id}', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');
        Route::get('/division/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');
        // Ship Division All Route End


        // Ship District All Route Start
        Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage-district');
        Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');
        Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');
        Route::post('/district/update/{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');
        Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');
        // Ship District All Route End


        // Ship Upazila All Route Start
        Route::get('/upazila/view', [ShippingAreaController::class, 'UpazilaView'])->name('manage-upazila');
        Route::post('/upazila/store', [ShippingAreaController::class, 'UpazilaStore'])->name('upazila.store');
        Route::get('/upazila/edit/{id}', [ShippingAreaController::class, 'UpazilaEdit'])->name('upazila.edit');
        Route::post('/upazila/update/{id}', [ShippingAreaController::class, 'UpazilaUpdate'])->name('upazila.update');
        Route::get('/upazila/delete/{id}', [ShippingAreaController::class, 'UpazilaDelete'])->name('upazila.delete');
        Route::get('/district-get/ajax/{division_id}', [ShippingAreaController::class, 'DistrictGetAjax']);
        // Ship Upazila All Route End

    });
    // Admin Shipping All Route End


    // Admin Order All Route Start
    Route::prefix('orders')->group(function() {
        Route::get('/pending/orders', [OrderController::class, 'PendingOrders'])->name('prnding-orders');

        Route::get('/pending/orders/edit/{order_id}', [OrderController::class, 'PendingOrdersEdit'])->name('prnding-orders.edit');
        Route::post('/pending/orders/update/{order_id}', [OrderController::class, 'PendingOrdersUpdate'])->name('prnding-orders.update');
        Route::post('/pending/orders/status/update/{order_id}', [OrderController::class, 'PendingOrdersStatusUpdate'])->name('prnding-orders.status.update');

        Route::get('/pending/orders/details/{order_id}', [OrderController::class, 'PendingOrdersDetails'])->name('pending.order.details');
        Route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrders'])->name('confirmed-orders');
        Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('processing-orders');
        Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders');
        Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders');
        Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders');
        Route::get('/cancel/orders', [OrderController::class, 'CancelOrders'])->name('cancel-orders');

        // Order Status Update
        Route::get('/order/cancel/admin/{order_id}', [OrderController::class, 'OrdersCancelAdmin'])->name('orders.cancel.admin');
        Route::get('/pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm');
        Route::get('/confirm/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm.processing');
        Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing.picked');
        Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked.shipped');
        Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped.delivered');

        Route::get('/invoice/download/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');
    });
    // Admin Order All Route End



    // Dashboard Pending Orders Search Route Start
    Route::get('/pending/search', [DashboardController::class, 'PendingSearch'])->name('pending.search');
    Route::get('/pending/search_value/{search_value}', [DashboardController::class, 'PendingSearch_Value']);
    // Dashboard Pending Orders Search Route End



    // Admin Reports All Route Start
    Route::prefix('reports')->group(function() {
        Route::get('/view', [ReportController::class, 'ReportView'])->name('all-reports');
        Route::post('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date');
        Route::post('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month');
        Route::post('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year');
        Route::post('/search/by/report', [ReportController::class, 'ReportByReport'])->name('search-by-report');
    });
    // Admin Reports All Route End 



    // Admin Blog All Route Start
    Route::prefix('blog')->group(function() {
        Route::get('/category', [BlogController::class, 'BlogCategory'])->name('blog.category');
        Route::post('/store', [BlogController::class, 'BlogCategoryStore'])->name('blogcategory.store');
        Route::get('/category/edit/{id}', [BlogController::class, 'BlogCategoryEdit'])->name('blog.category.edit');
        Route::post('/update/{id}', [BlogController::class, 'BlogCategoryUpdate'])->name('blogcategory.update');
        Route::get('/delete/{id}', [BlogController::class, 'BlogCategoryDelete'])->name('blog.category.delete');

        // Admin View Blog All Route Start
        Route::get('/list/post', [BlogController::class, 'ListBlogPost'])->name('list.post');
        Route::get('/add/post', [BlogController::class, 'AddBlogPost'])->name('add.post');
        Route::post('/post/store', [BlogController::class, 'BlogPostStore'])->name('post-store');
        // Admin View Blog All Route End
    });
    // Admin Blog All Route End


    // Admin Blog All Route Start
    Route::prefix('sidebar')->group(function() {
        Route::get('/top-sidebar/view', [SidebarController::class, 'TopSidebarView'])->name('top_sidebar.view');
        Route::get('/top-sidebar/add', [SidebarController::class, 'TopSidebarAdd'])->name('top_sidebar.add');
        Route::post('/top-sidebar/store', [SidebarController::class, 'TopSidebarStore'])->name('top_sidebar.store');
        Route::get('/top-sidebar/edit/{id}', [SidebarController::class, 'TopSidebarEdit'])->name('top_sidebar.edit');
        Route::post('/top-sidebar/update/{id}', [SidebarController::class, 'TopSidebarUpdate'])->name('top_sidebar.update');
    });
    // Admin Blog All Route End



    // Admin Site Setting All Route Start
    Route::prefix('setting')->group(function() {
        Route::get('/seo', [SiteSettingController::class, 'SeoSetting'])->name('seo.setting');
        Route::post('/seo/update/{id}', [SiteSettingController::class, 'SeoSettingUpdate'])->name('update.seosetting');
        Route::get('/site', [SiteSettingController::class, 'SiteSetting'])->name('site.setting');
        Route::post('/site/update/{id}', [SiteSettingController::class, 'SiteSettingUpdate'])->name('update.sitesetting');
    });
    // Admin Site Setting All Route End



    // Admin Return Order All Route Start
    Route::prefix('return')->group(function() {
        Route::get('/admin/request', [ReturnController::class, 'ReturnRequest'])->name('return.request');
        Route::get('/admin/return/approve/{order_id}', [ReturnController::class, 'ReturnRequestApprove'])->name('return.approve');
        Route::get('/admin/all/request/approve', [ReturnController::class, 'ReturnAllRequestApprove'])->name('all.request.approve');
        Route::get('/admin/return/cancel/{order_id}', [ReturnController::class, 'ReturnRequestCancel'])->name('return.cancel');
        Route::get('/admin/all/request/cancel', [ReturnController::class, 'ReturnAllRequestCancel'])->name('all.request.cancel');
    });
    // Admin Return Order All Route End


    // Admin Manage Stock All Route Start
    Route::prefix('stock')->group(function() {
        Route::get('/product', [ProductController::class, 'ProductStock'])->name('product.stock');
        Route::get('/request', [ProductController::class, 'StockRequest'])->name('stock.request');
        Route::get('/request/delete/{id}', [ProductController::class, 'StockRequestDelete'])->name('stock.request.delete');
        // Route::get('/product/stock_qty/edit/{id}', [ProductController::class, 'ProductStockQtyEdit'])->name('product.stock_qty.edit');
        Route::post('/product/stock_qty/update', [ProductController::class, 'ProductStockQtyUpdate'])->name('product.stock_qty.update');
    });
    // Admin Manage Stock All Route End




    // Admin Role Permission All Route Start
    // Route::prefix('rolepermission')->middleware('permission:all_user')->group(function () {
    Route::prefix('rolepermission')->group(function () {

        Route::get('/roules', [RoleController::class, 'index'])->name('roles.index');
        Route::post('/roules/store', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/roules/edit/{role}', [RoleController::class, 'edit'])->name('role.edit');        
        Route::post('/roules/update/{role}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/roules/delete/{role}', [RoleController::class, 'destroy'])->name('role.delete');

        Route::get('/permissions', [PermissionController::class,'index'])->name('permission.index');
        Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/permissions/edit/{permission}', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::post('/permissions/update/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::get('/permissions/delete/{permission}', [PermissionController::class, 'destroy'])->name('permissions.delete');

        
        Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
        Route::get('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
        
        Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
        Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
        
        Route::get('/adminuser/users', [AdminUserController::class, 'index'])->name('adminuser.index');
        Route::get('/adminuser/{user}', [AdminUserController::class, 'show'])->name('adminuser.show');
        Route::post('/adminuser/store', [AdminUserController::class, 'store'])->name('adminuser.store');
        Route::get('/adminuser/edit/{user}', [AdminUserController::class, 'edit'])->name('adminuser.edit');
        Route::post('/adminuser/update/{user}', [AdminUserController::class, 'Update'])->name('adminuser.update');
        Route::get('/adminuser/destroy/{user}', [AdminUserController::class, 'destroy'])->name('adminuser.destroy');
        Route::post('/adminuser/{user}/roles', [AdminUserController::class, 'assignRole'])->name('adminuser.roles');
        Route::delete('/adminuser/{user}/roles/{role}', [AdminUserController::class, 'removeRole'])->name('adminuser.roles.remove');
        Route::post('/adminuser/{user}/permissions', [AdminUserController::class, 'givePermission'])->name('adminuser.permissions');
        Route::delete('/adminuser/{user}/permissions/{permission}', [AdminUserController::class, 'revokePermission'])->name('adminuser.permissions.revoke');
    });
    // Admin Role Permission All Route End



    
});
// Admin Section All Routes End 


    // // Admin Get All User Route Start
    Route::prefix('alluser')->group(function () {
        Route::get('/view', [AdminProfileController::class, 'AllUsers'])->name('all-users');
        // Route::get('/edit/{id}', [AdminProfileController::class, 'AllUsersEdit'])->name('all-users.edit');
        // Route::post('/update/{id}', [AdminProfileController::class, 'AllUsersUpdate'])->name('all-users.update');
        Route::get('/show/{id}', [AdminProfileController::class, 'AllUsersShow'])->name('all-users.show');
        // Route::get('/delete/{id}', [AdminProfileController::class, 'AllUsersDelete'])->name('all-users.delete');
    });
    // // Admin Get All User Route End










////////////////////////////////  Frontend Start  /////////////////////////////////////


// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified' ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


 ////  User Must Login  ////
Route::group(['prefix' => 'user', 'middleware' => ['web', 'auth'], 'namespace' => 'User'], function () {

    // Frontend Wishlist page All Route Start
    Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');
    Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']);
    // Frontend Wishlist page All Route End

    // Frontend Roder All Route Start
    Route::get('/my/orders', [AllUserController::class, 'MyOrders'])->name('my.orders');
    Route::get('/order_details/{order_id}', [AllUserController::class, 'OrderDetails']);
    Route::get('/invoice_download/{order_id}', [AllUserController::class, 'InvoiceDownload']);
    Route::post('/return/order/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');
    Route::get('/return/order/list', [AllUserController::class, 'ReturnOrderList'])->name('return.order.list');
    Route::get('/order/cancel/{order_id}', [AllUserController::class, 'OrdersCancel'])->name('orders.cancel');
    Route::get('/cancel/orders', [AllUserController::class, 'CancelOrders'])->name('cancel.orders');
    // Frontend Roder All Route End

    /// Order Traking Route 
    // Route::post('/order/tracking', [AllUserController::class, 'OrderTraking'])->name('order.tracking');

    // Payments Gateway Stripe Route Start
    // Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');
    Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');
    // Payments Gateway Stripe Route End

    //logged in user profile view edit update
    Route::get('/profile', [UserController::class, 'ShowProfilePage'])->name('user.profile');
    Route::get('/pass/change', [UserController::class, 'ShowChangePass'])->name('user.password');
    Route::post('/profile/update/{user_id}', [UserController::class, 'UpdateProfile'])->name('user.profile.update');
    Route::post('/user/change/password', [UserController::class, 'UserChangePassword'])->name('change.password');

}); 


    // Frontend Coupon All Route Start
    Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
    Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
    Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);
    // Frontend Coupon All Route End


    // Frontend Checkout All Route Start 
    Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
    Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);
    Route::get('/upazila-get/ajax/{district_id}', [CheckoutController::class, 'UpazilaGetAjax']);
    Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');
    // Frontend Checkout All Route End 
    
// aaaa
// aaaa
// aaaa


//logout user
Route::get('logout', [UserController::class, 'destroy'])->name('user.logout');
// ////Main root route////
Route::get('/', [IndexController::class, 'index'])->name('front_index');

// Google login route //
Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

// Developer Information Route Start
Route::get('/developer', [IndexController::class, 'Developer'])->name('developer');
// Developer Information Route End

Route::get('product/brand/{brand_id}', [IndexController::class,'ShowBrandProduct'])->name('product.brand');

Route::get('product/category/{mainCategory_id}', [IndexController::class,'ShowCategoryProduct'])->name('product.category');
Route::get('product/subcategory/{subCategory_id}', [IndexController::class,'ShowSubCategoryProduct'])->name('product.subcategory');
Route::get('product/subsubcategory/{subsubCategory_id}', [IndexController::class,'ShowSubSubCategoryProduct'])->name('product.subsubcategory');

Route::get('product/category/ajax/{mainCategory_id}', [IndexController::class,'ShowCategoryProduct'])->name('ajax.category');

//language session//
Route::get('/language/bangla',[IndexController::class, 'Bangla'])->name('bangla.language');
Route::get('/language/english',[IndexController::class, 'English'])->name('english.language');
//signin//
Route::post('/loginOrSignup', [UserController::class, 'loginOrSignup'])->name('loginOrSignup');
Route::get('/login', [UserController::class, 'login'])->name('login');

//front Product Detail Page URL 
Route::get('product/details/{id}',[IndexController::class, 'ProductDetail']);

// Product View Modal with Ajax
Route::get('/productone/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);
Route::POST('/productone/direct/cart', [CartController::class, 'ProductDirectAdd'])->name('direct.cart');
Route::POST('/productone/request/stock', [CartController::class, 'ProductRequestStock'])->name('request.stock');

// Add to Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Get Data from mini cart
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']);

// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

// Add to Wishlist
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishlist']);



// My Cart Page All Routes
Route::get('/mycart', [CartPageController::class, 'MyCart'])->name('mycart');

Route::get('/user/get-cart-product', [CartPageController::class, 'GetCartProduct']);

Route::get('/user/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);

Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);

Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);


Route::get('/category/{mainCategory_id}/{mainCategory_name}', [ProductPageController::class, 'ShowProductCategoryPage'])->name('productPage.category');
Route::get('/author/{author_id}/{author_name}', [ProductPageController::class, 'ShowProductAuthorPage'])->name('productPage.author');
Route::get('/sub_category/{subCategory_id}/{subCategory_name}', [ProductPageController::class, 'ShowProductSubCategoryPage'])->name('productPage.subcategory');
Route::get('/sub_sub_category/{subSubCategory_id}/{subSubCategory_name}', [ProductPageController::class, 'ShowProductSubSubCategoryPage'])->name('productPage.subsubcategory');

Route::get('/slider/front/show', [IndexController::class, 'ShowSlider']);
Route::get('/slider/category/show/{main_category}', [IndexController::class, 'ShowCategorySlider']);
Route::get('/slider/subcategory/show/{main_category}', [IndexController::class, 'ShowSubCategorySlider']);
Route::get('/slider/subsubcategory/show/{main_category}', [IndexController::class, 'ShowSubSubCategorySlider']);
Route::get('/slider/top_sidebar_menu_slider/show/{main_category}', [IndexController::class, 'ShowTop_sidebar_menu_sliderSlider']);

// Route::get('/profile', [UserController::class, 'ShowProfilePage'])->name('user.profile');
// Route::get('/pass/change', [UserController::class, 'ShowChangePass'])->name('user.password');
// Route::post('/profile/update/{user_id}', [UserController::class, 'UpdateProfile'])->name('user.profile.update');
// Route::post('/user/change/password', [UserController::class, 'UserChangePassword'])->name('change.password');
//aaa
Route::get('/special_product', [ProductPageController::class, 'ShowSpecialPage'])->name('productPage.special');
Route::get('/special_product/{product_id}', [ProductPageController::class, 'ShowSpecial'])->name('product.special');

Route::get('/special_deal', [ProductPageController::class, 'ShowSpecialDealPage'])->name('productPage.special.deal');
Route::get('/special_deal/{product_id}', [ProductPageController::class, 'ShowSpecialDeal'])->name('product.special.deal');

Route::get('/featured', [ProductPageController::class, 'ShowFeaturedPage'])->name('productPage.featured');
Route::get('/featured/{product_id}', [ProductPageController::class, 'ShowFeatured'])->name('product.featured');

Route::get('/hot_deal', [ProductPageController::class, 'ShowHotDealPage'])->name('productPage.hotdeal');
Route::get('/hot_deal/{product_id}', [ProductPageController::class, 'ShowHotDeal'])->name('product.hotdeal');

Route::get('/All_Brand', [ProductPageController::class, 'ShowAllBrandPage'])->name('productPage.brand');
Route::get('/Brand_product/{brand_id}', [ProductPageController::class, 'ShowSingleBrandPage'])->name('productPage.single.brand');
Route::get('/get/product-name/', [ProductPageController::class, 'get_product_name']);
//ooo

Route::get('/dashboard', function () {
    return redirect('/');
});
Route::post('/phone/authenticate', [UserController::class, 'MobileLogin'])->name('phone.authenticate');


Route::get('Security/Policy', [IndexController::class, 'SecurityPolicy'])->name('SecurityPolicy');
Route::get('Shipping/Replacement', [IndexController::class, 'ShippingReplacement'])->name('ShippingReplacement');
Route::get('Privacy/Policy', [IndexController::class, 'PrivacyPolicy'])->name('PrivacyPolicy');
Route::get('Terms/Use', [IndexController::class, 'TermsUse'])->name('TermsUse');

Route::get('grocery/product', [ProductPageController::class, 'GroceryProduct'])->name('grocery.product');
// Route::get('garments/product', [ProductPageController::class, 'GarmentsProduct'])->name('garments.product');
// Route::get('cosmetics/product', [ProductPageController::class, 'CosmeticsProduct'])->name('cosmetics.product');
// Route::get('medicines/product', [ProductPageController::class, 'MedicinesProduct'])->name('medicines.product');

Route::get('search/{product_name}', [ProductPageController::class, 'SearchProduct'])->name('search.product');
Route::post('search/data', [ProductPageController::class, 'SearchProductData'])->name('search.product.data');


// Route::get('electronic/product', [ProductPageController::class, 'ElectronicProduct'])->name('electronic.product');
// Route::get('gift/product', [ProductPageController::class, 'GiftProduct'])->name('gift.product');
// Route::get('kids/product', [ProductPageController::class, 'KidsProduct'])->name('kids.product');
// Route::get('pharmacy/product', [ProductPageController::class, 'PharmacyProduct'])->name('pharmacy.product');

Route::get('/topmenu/{mainCategory_id}/{mainCategory_name}', [ProductPageController::class, 'ShowProductSideBarTopMenuPage'])->name('productPage.topmenu');

Route::get('about/us', [IndexController::class, 'AboutUs'])->name('about.us');
Route::get('contact/us', [IndexController::class, 'ContactUs'])->name('contact.us');
Route::get('howto/buy', [IndexController::class, 'HowToBuy'])->name('how.buy');

Route::get('/sidebar/view/ajax/',  [IndexController::class, 'SidebarAjax']);
//test



// Route::get('/storage', function () {
//     // Artisan::call('storage:link');
//     $target = '/home/airticketbanglad/public_html/fmshop/storage';
//     $link = '/home/airticketbanglad/public_html/fmshop/fmshop_app/storage/app/public';
//     echo symlink($link, $target);
//     // echo readlink($link);
// });


// Route::get('/storage', function () {
//     // Artisan::call('storage:link');
//     $target = '/home/fmdailys/public_html/storage';
//     $link = '/home/fmdailys/public_html/fmdailyshop_app/storage/app/public';
//     echo symlink($link, $target);
//     // echo readlink($link);
// });
