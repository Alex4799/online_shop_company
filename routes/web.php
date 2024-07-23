<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\UserInterfaceController;

// admin and user

Route::middleware(['session'])->group(function () {
    Route::get('/loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('/registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::get('get/interface',[UserInterfaceController::class,'getInterface'])->name('auth#getInterface');
Route::get('get/payment/{id}',[PaymentMethodController::class,'getPayment'])->name('getPayment');
Route::get('get/user/payment/{id}',[PaymentMethodController::class,'getUserPayment'])->name('getUserPayment');

Route::middleware(['auth:sanctum','verified'])->group(function () {

    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('auth#dashboard');
    Route::post('change/password',[AuthController::class,'changePassword'])->name('auth#changePassword');
    Route::get('get/message',[MessageController::class,'getMessage'])->name('getMessage');
    Route::get('notActive',[AuthController::class,'notActive'])->name('notActive');
    // admin
    Route::middleware(['adminAuth'])->group(function () {
        Route::prefix('admin')->group(function () {

            Route::get('edit/interface',[UserInterfaceController::class,'editInterface'])->name('admin#editInterface');
            Route::post('update/interface',[UserInterfaceController::class,'updateInterface'])->name('admin#updateInterface');
            Route::get('editAboutImage',[UserInterfaceController::class,'editAboutImage_admin'])->name('admin#editAboutImage');
            Route::post('updateAboutImage',[UserInterfaceController::class,'updateAboutImage_admin'])->name('admin#updateAboutImage');
            Route::post('addAboutImage',[UserInterfaceController::class,'addAboutImage_admin'])->name('admin#addAboutImage');
            Route::get('deleteAboutImage/{index}',[UserInterfaceController::class,'deleteAboutImage_admin'])->name('admin#deleteAboutImage');


            Route::get('profile',[AdminController::class,'adminProfile'])->name('admin#profile');
            Route::post('update',[AdminController::class,'adminProfileUpdate'])->name('admin#profileUpdate');
            Route::get('delete/profile/photo/{id}',[AdminController::class,'adminDeleteProfile'])->name('admin#deleteProfile');

            Route::get('list',[AdminController::class,'adminList'])->name('admin#list');
            Route::get('addPage',[AdminController::class,'adminAddPage'])->name('admin#addPage');
            Route::post('add',[AdminController::class,'adminAdd'])->name('‌admin#add');
            Route::get('view/{id}',[AdminController::class,'adminView'])->name('admin#view');
            Route::get('delete/{id}',[AdminController::class,'adminDelete'])->name('admin#delete');

            Route::prefix('user')->group(function () {
                Route::get('list',[AdminController::class,'userList'])->name('admin#userList');
                Route::get('addPage',[AdminController::class,'userAddPage'])->name('admin#userAddPage');
                Route::post('add',[AdminController::class,'userAdd'])->name('admin#addUser');
                Route::get('view/{id}',[AdminController::class,'userView'])->name('admin#viewUser');
                Route::get('delete/{id}',[AdminController::class,'userDelete'])->name('admin#deleteUser');
            });

            Route::prefix('category')->group(function () {
                Route::get('list',[CategoryController::class,'list_admin'])->name('admin#categoryList');
                Route::get('addPage',[CategoryController::class,'addPage_admin'])->name('admin#categoryAddPage');
                Route::post('add',[CategoryController::class,'add_admin'])->name('admin#addCategory');
                Route::get('view/{id}',[CategoryController::class,'view_admin'])->name('admin#viewCategory');
                Route::get('edit/{id}',[CategoryController::class,'edit_admin'])->name('admin#editCategory');
                Route::post('update',[CategoryController::class,'update_admin'])->name('admin#updateCategory');
                Route::get('delete/{id}',[CategoryController::class,'delete_admin'])->name('admin#deleteCategory');
            });

            Route::prefix('product')->group(function () {
                Route::get('list',[ProductController::class,'list_admin'])->name('admin#productList');
                Route::get('addPage',[ProductController::class,'addPage_admin'])->name('admin#productAddPage');
                Route::post('add',[ProductController::class,'add_admin'])->name('admin#productAdd');
                Route::get('view/{id}',[ProductController::class,'view_admin'])->name('admin#productView');
                Route::get('edit/{id}',[ProductController::class,'edit_admin'])->name('admin#editProduct');
                Route::get('editImage/{id}',[ProductController::class,'editImage_admin'])->name('admin#editProductImage');
                Route::post('updateImage',[ProductController::class,'updateImage_admin'])->name('admin#updateProductImage');
                Route::post('addImage',[ProductController::class,'addImage_admin'])->name('admin#addProductImage');
                Route::get('deleteImage/{id}/{index}',[ProductController::class,'deleteImage_admin'])->name('admin#deleteProductImage');
                Route::post('update',[ProductController::class,'update_admin'])->name('admin#updateProduct');
                Route::get('delete/{id}',[ProductController::class,'delete_admin'])->name('admin#deleteProduct');
            });

            Route::prefix('brand')->group(function () {
                Route::get('list',[BrandController::class,'list_admin'])->name('admin#brandList');
                Route::get('addPage',[BrandController::class,'addPage_admin'])->name('admin#brandAddPage');
                Route::post('add',[BrandController::class,'add_admin'])->name('admin#addBrand');
                Route::get('view/{id}',[BrandController::class,'view_admin'])->name('admin#viewBrand');
                Route::get('edit/{id}',[BrandController::class,'edit_admin'])->name('admin#editBrand');
                Route::post('update',[BrandController::class,'update_admin'])->name('admin#updateBrand');
                Route::get('delete/{id}',[BrandController::class,'delete_admin'])->name('admin#deleteBrand');
            });

            Route::prefix('supplier')->group(function () {
                Route::get('list',[SupplierController::class,'list_admin'])->name('admin#supplierList');
                Route::get('view/{id}',[SupplierController::class,'view_admin'])->name('admin#viewSupplier');
                Route::get('delete/{id}',[SupplierController::class,'delete_admin'])->name('admin#deleteSupplier');
                Route::get('change/{status}/{id}',[SupplierController::class,'changeStatus_admin'])->name('admin#changeStatus');
                Route::get('get/interface',[SupplierController::class,'getSupplierInterface_admin'])->name('admin#getSupplierInterface');

                Route::prefix('product')->group(function () {
                    Route::get('list',[SupplierController::class,'listProduct_admin'])->name('admin#supplier_productList');
                    Route::get('addPage',[SupplierController::class,'addPageProduct_admin'])->name('admin#supplier_productAddPage');
                    Route::post('add',[SupplierController::class,'addProduct_admin'])->name('admin#supplier_productAdd');
                    Route::get('view/{id}',[SupplierController::class,'viewProduct_admin'])->name('admin#supplier_productView');
                    Route::get('edit/{id}',[SupplierController::class,'editProduct_admin'])->name('admin#supplier_editProduct');
                    Route::get('editImage/{id}',[SupplierController::class,'editImageProduct_admin'])->name('admin#supplier_editProductImage');
                    Route::post('updateImage',[SupplierController::class,'updateImageProduct_admin'])->name('admin#supplier_updateProductImage');
                    Route::post('addImage',[SupplierController::class,'addImageProduct_admin'])->name('admin#supplier_addProductImage');
                    Route::get('deleteImage/{id}/{index}',[SupplierController::class,'deleteImageProduct_admin'])->name('admin#supplier_deleteProductImage');
                    Route::post('update',[SupplierController::class,'updateProduct_admin'])->name('admin#supplier_updateProduct');
                    Route::get('delete/{id}',[SupplierController::class,'deleteProduct_admin'])->name('admin#supplier_deleteProduct');
                });
            });

            Route::prefix('order')->group(function () {
                Route::get('list',[OrderController::class,'list_admin'])->name('admin#orderList');
                Route::get('view/{id}',[OrderController::class,'view_admin'])->name('admin#orderView');
            });

            Route::prefix('purchase')->group(function () {
                Route::get('list',[PurchaseController::class,'list_admin'])->name('admin#listPurchase');
                Route::get('view/{id}',[PurchaseController::class,'view_admin'])->name('admin#viewPurchase');
            });

            Route::prefix('dashboard')->group(function () {
                Route::get('/',[AdminController::class,'dashboard'])->name('admin#dashboard');
                Route::get('report',[AdminController::class,'report'])->name('admin#report');
                Route::post('view/report',[AdminController::class,'viewReport'])->name('admin#viewReport');
            });

            Route::prefix('message')->group(function () {
                Route::get('list/{status}',[MessageController::class,'list_admin'])->name('admin#messageList');
                Route::get('addPage/{reply_id?}',[MessageController::class,'addPage_admin'])->name('admin#messageAddPage');
                Route::post('add',[MessageController::class,'add_admin'])->name('admin#addMessage');
                Route::get('view/{id}',[MessageController::class,'view_admin'])->name('admin#viewMessage');
                Route::get('send/all',[MessageController::class,'sendAllPage'])->name('admin#sendAllMessagePage');
                Route::post('send/all',[MessageController::class,'sendAll'])->name('admin#sendAllMessage');
                Route::get('reply/reportPage/{id}',[MessageController::class,'replyReportPage'])->name('admin#replyReportPage');
                Route::post('reply/report',[MessageController::class,'replyReport'])->name('admin#replyReport');
                Route::get('send/user/{id}',[MessageController::class,'sendUser_admin'])->name('admin#sendUser');
                Route::get('get/report',[MessageController::class,'getReport'])->name('admin#getReport');
            });

        });

    });

    // user
    Route::middleware(['userAuth'])->group(function () {

        Route::prefix('user')->group(function () {
            Route::get('profile',[UserController::class,'userProfile'])->name('user#profile');
            Route::post('update',[UserController::class,'userProfileUpdate'])->name('user#profileUpdate');
            Route::get('delete/profile/photo/{id}',[UserController::class,'userDeleteProfile'])->name('user#deleteProfile');
            Route::get('dashboard',[UserController::class,'myDashboard'])->name('user#myDashboard');
            Route::get('report',[UserController::class,'report'])->name('user#report');
            Route::post('view/report',[UserController::class,'viewReport'])->name('user#viewReport');

            Route::get('showCategory',[UserController::class,'showCategory'])->name('user#showCategory');
            Route::post('add/showCategory',[UserController::class,'addShowCategory'])->name('user#addShowCategory');
            Route::post('updateCategory',[UserController::class,'updateCategory'])->name('user#updateProductCategory');
            Route::get('deleteCategory/{index}',[UserController::class,'deleteCategory'])->name('user#deleteProductCategory');

            Route::get('admin/list',[UserController::class,'adminList'])->name('user#adminList');
            Route::get('admin/view/{id}',[UserController::class,'adminView'])->name('user#adminView');

            Route::prefix('category')->group(function () {
                Route::get('list',[CategoryController::class,'list_user'])->name('user#categoryList');
                Route::get('addPage',[CategoryController::class,'addPage_user'])->name('user#categoryAddPage');
                Route::post('add',[CategoryController::class,'add_user'])->name('user#addCategory');
                Route::get('view/{id}',[CategoryController::class,'view_user'])->name('user#viewCategory');
                Route::get('edit/{id}',[CategoryController::class,'edit_user'])->name('user#editCategory');
                Route::post('update',[CategoryController::class,'update_user'])->name('user#updateCategory');
                Route::get('delete/{id}',[CategoryController::class,'delete_user'])->name('user#deleteCategory');
            });

            Route::prefix('product')->group(function () {
                Route::get('list',[ProductController::class,'list_user'])->name('user#productList');
                Route::get('addPage',[ProductController::class,'addPage_user'])->name('user#productAddPage');
                Route::post('add',[ProductController::class,'add_user'])->name('user#productAdd');
                Route::get('view/{id}',[ProductController::class,'view_user'])->name('user#productView');
                Route::get('edit/{id}',[ProductController::class,'edit_user'])->name('user#editProduct');
                Route::get('editImage/{id}',[ProductController::class,'editImage_user'])->name('user#editProductImage');
                Route::post('updateImage',[ProductController::class,'updateImage_user'])->name('user#updateProductImage');
                Route::post('addImage',[ProductController::class,'addImage_user'])->name('user#addProductImage');
                Route::get('deleteImage/{id}/{index}',[ProductController::class,'deleteImage_user'])->name('user#deleteProductImage');
                Route::post('update',[ProductController::class,'update_user'])->name('user#updateProduct');
                Route::get('delete/{id}',[ProductController::class,'delete_user'])->name('user#deleteProduct');
            });

            Route::prefix('brand')->group(function () {
                Route::get('list',[BrandController::class,'list_user'])->name('user#brandList');
                Route::get('addPage',[BrandController::class,'addPage_user'])->name('user#brandAddPage');
                Route::post('add',[BrandController::class,'add_user'])->name('user#addBrand');
                Route::get('view/{id}',[BrandController::class,'view_user'])->name('user#viewBrand');
                Route::get('edit/{id}',[BrandController::class,'edit_user'])->name('user#editBrand');
                Route::post('update',[BrandController::class,'update_user'])->name('user#updateBrand');
                Route::get('delete/{id}',[BrandController::class,'delete_user'])->name('user#deleteBrand');
            });

            Route::prefix('supplier')->group(function () {
                Route::get('pendingPage',[SupplierController::class,'pendingPage_user'])->name('user#pendingSupplierPage');
                Route::post('pending',[SupplierController::class,'pending_user'])->name('user#pendingSupplier');
                Route::prefix('product')->group(function () {
                    Route::get('list',[SupplierController::class,'listProduct_user'])->name('user#supplier_productList');
                    Route::get('addPage',[SupplierController::class,'addPageProduct_user'])->name('user#supplier_productAddPage');
                    Route::post('add',[SupplierController::class,'addProduct_user'])->name('user#supplier_productAdd');
                    Route::get('view/{id}',[SupplierController::class,'viewProduct_user'])->name('user#supplier_productView');
                    Route::get('edit/{id}',[SupplierController::class,'editProduct_user'])->name('user#supplier_editProduct');
                    Route::get('editImage/{id}',[SupplierController::class,'editImageProduct_user'])->name('user#supplier_editProductImage');
                    Route::post('updateImage',[SupplierController::class,'updateImageProduct_user'])->name('user#supplier_updateProductImage');
                    Route::post('addImage',[SupplierController::class,'addImageProduct_user'])->name('user#supplier_addProductImage');
                    Route::get('deleteImage/{id}/{index}',[SupplierController::class,'deleteImageProduct_user'])->name('user#supplier_deleteProductImage');
                    Route::post('update',[SupplierController::class,'updateProduct_user'])->name('user#supplier_updateProduct');
                    Route::get('delete/{id}',[SupplierController::class,'deleteProduct_user'])->name('user#supplier_deleteProduct');
                });
            });

            Route::prefix('purchase')->group(function () {

                Route::prefix('user')->group(function () {
                    Route::get('supplier/list',[PurchaseController::class,'supplierList_user'])->name('user#supplierList');
                    Route::get('product/list/{id}',[PurchaseController::class,'productList_user'])->name('user#supplierProductList');
                    Route::get('product/view/{id}',[PurchaseController::class,'productView_user'])->name('user#supplierProductView');


                    Route::get('list',[PurchaseController::class,'list_user'])->name('user#listPurchase');
                    Route::get('addPage/{id}',[PurchaseController::class,'addPage_user'])->name('user#addPurchasePage');
                    Route::post('add',[PurchaseController::class,'add_user'])->name('user#addPruchase');
                    Route::get('view/{id}',[PurchaseController::class,'view_user'])->name('user#viewPurchase');

                });
                Route::prefix('supplier')->group(function () {
                    Route::get('list',[PurchaseController::class,'list_supplier'])->name('supplier#listPurchase');
                    Route::get('view/{id}',[PurchaseController::class,'view_supplier'])->name('supplier#viewPurchase');
                    Route::get('change/{status}/{id}',[PurchaseController::class,'changeStatus_supplier'])->name('supplier#changeStatus');
                    Route::get('get/interface',[PurchaseController::class,'getPurchaseinterface'])->name('user#getPurchaseinterface');
                });
            });

            Route::prefix('order')->group(function () {
                Route::get('list',[OrderController::class,'list_seller'])->name('seller#listOrder');
                Route::get('view/{invoice_id}',[OrderController::class,'view_seller'])->name('seller#viewOrder');
                Route::get('change/{status}/{id}',[OrderController::class,'changeStatus_seller'])->name('seller#changeStatus');
                Route::get('get/interface',[OrderController::class,'getOrderinterface'])->name('user#getOrderinterface');

            });

            Route::prefix('payment')->group(function () {
                Route::get('list',[PaymentMethodController::class,'paymentList_user'])->name('user#paymentList');
                Route::get('addPage',[PaymentMethodController::class,'paymentAddPage_user'])->name('user#paymentAddPage');
                Route::post('add',[PaymentMethodController::class,'paymentAdd_user'])->name('user#paymentAdd');
                Route::get('edit/{id}',[PaymentMethodController::class,'paymentEdit_user'])->name('user#paymentEdit');
                Route::post('update',[PaymentMethodController::class,'paymentUpdate_user'])->name('user#paymentUpdate');
                Route::get('delete/{id}',[PaymentMethodController::class,'paymentDelete_user'])->name('user#paymentDelete');
            });

            Route::prefix('message')->group(function () {
                Route::get('list/{status?}',[MessageController::class,'list_user'])->name('user#messageList');
                Route::get('addPage/{reply_id?}',[MessageController::class,'addPage_user'])->name('user#messageAddPage');
                Route::post('add',[MessageController::class,'add_user'])->name('user#addMessage');
                Route::get('view/{id}',[MessageController::class,'view_user'])->name('user#viewMessage');
                Route::get('send/{id}',[MessageController::class,'sendUser_user'])->name('user#sendUser');

            });

        });



    });




});

// customer
Route::redirect('/', 'customer/home');
Route::prefix('customer')->group(function () {
    Route::get('/home',[CustomerController::class,'home'])->name('customer#home');
    Route::get('/about',[CustomerController::class,'about'])->name('customer#about');

    Route::prefix('category')->group(function () {
        Route::get('list',[CategoryController::class,'categoryList_customer'])->name('customer#categoryList');
        Route::get('product/list/{id}',[CategoryController::class,'categoryProductList'])->name('customer#categoryProductList');

    });

    Route::prefix('brand')->group(function () {
        Route::get('list',[BrandController::class,'brandList_customer'])->name('customer#brandList');
        Route::get('product/list/{id}',[BrandController::class,'brandProductList'])->name('customer#brandProductList');

    });

    Route::prefix('seller')->group(function () {
        Route::get('list',[UserController::class,'userList_customer'])->name('customer#sellerList');
        Route::get('profile/{id}',[UserController::class,'seller_profile_customer'])->name('customer#sellerProfile');
        Route::get('product/list/{id}',[UserController::class,'userProductList'])->name('customer#sellerProductList');

    });

    Route::prefix('product')->group(function () {
        Route::get('list',[ProductController::class,'allList_customer'])->name('customer#productList');
        Route::get('view/{id}',[ProductController::class,'view_customer'])->name('customer#viewProduct');
        Route::get('get',[ProductController::class,'get_customer'])->name('customer#getProduct');
    });

    Route::prefix('cart')->group(function () {
        Route::get('list',[CustomerController::class,'cartList_customer'])->name('customer#cartList');
    });

    Route::prefix('order')->group(function () {
        Route::get('addPage/{id}',[OrderController::class,'addPage_customer'])->name('customer#orderAddPage');
        Route::post('add',[OrderController::class,'orderAdd_customer'])->name('customer#orderAdd');
        Route::get('summary/{invoice_id}',[OrderController::class,'orderSummary_customer'])->name('customer#orderSummary');
        Route::get('userVerify',[OrderController::class,'userVerify'])->name('customer#userVerify');
        Route::get('download/{invoice_id}',[OrderController::class,'downloadInvoice_user'])->name('customer#downloadInvoice');
        Route::get('checkPage',[OrderController::class,'checkPage'])->name('customer#checkPage');
        Route::post('check',[OrderController::class,'check'])->name('customer#check');
        Route::get('cancel/{id}',[OrderController::class,'cancel'])->name('customer#orderCancel');
    });

    Route::prefix('contact')->group(function () {
        Route::get('/',[CustomerController::class,'contact'])->name('customer#contact');
        Route::post('/send',[MessageController::class,'sendContact_customer'])->name('customer#sendContact');

    });

});
