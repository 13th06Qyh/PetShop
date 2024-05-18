<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix'=>'homeadmin', 'middleware' => 'role'], function (){
    Route::group(['prefix'=>'quanlykhachhang'], function (){
        Route::get('/', [AccountController::class, 'index'])->name('admin.customer');
        Route::get('/taomoitaikhoan', [AccountController::class, 'createadmin'])->name('admin.add.user');
        Route::post('/taomoitaikhoan/storeadmin', [AccountController::class, 'storeadmin'])->name('admin.add.storeadmin');
        Route::post('/{id}/suataikhoan', [AccountController::class, 'updateadmin'])->name('admin.edit.user');
        Route::post('/xoataikhoan/{id}', [AccountController::class, 'destroy'])->name('admin.delete.user');
        Route::post('/khoataikhoan/{id}', [AccountController::class, 'lock'])->name('admin.lock.user');
        Route::get('/danhsachden', [AccountController::class, 'blacklist'])->name('admin.blacklist.user');

    });
    // Route::get('/quanlykhachhang', [AccountController::class, 'index'])->name('admin.customer')->middleware('role');

    Route::group(['prefix'=>'quanlysanpham'], function (){
        Route::get('/', [SanPhamController::class, 'index'])->name('admin.sanpham');
        Route::get('/taomoisanpham', [SanPhamController::class, 'create'])->name('admin.add.sanpham');
        Route::post('/xoasanpham/{id}', [SanPhamController::class, 'destroy'])->name('admin.delete.sanpham');
        Route::post('/taotag', [SanPhamController::class, 'storeTag'])->name('admin.add.tag');
        Route::post('/taoprovide', [SanPhamController::class, 'storeProvide'])->name('admin.add.provide');
        Route::post('/taomoisanpham/storesanpham', [SanPhamController::class, 'storeSanPham'])->name('admin.add.storesanpham');
        Route::post('/{id}/suasanpham/updatesanpham', [SanPhamController::class, 'update'])->name('admin.edit.updatesanpham');

        // Route::post('/suasanpham', [SanPhamController::class, 'edit'])->name('admin.edit.sanpham');

    });
    // Route::get('/quanlysanpham', [UserController::class, 'view3'])->name('admin.sanpham')->middleware('role');

    Route::group(['prefix'=>'quanlydonhang'], function (){
        Route::get('/', [BillController::class, 'index'])->name('admin.bill');
        Route::get('/billdetail/{id}', [BillController::class, 'showDetailAdmin'])->name('admin.detail.bill');
        Route::post('/xoadonhang/{id}', [BillController::class, 'destroy'])->name('admin.delete.bill');
        Route::post('/{id}/capnhattrangthai/thanhtoan', [BillController::class, 'update'])->name('admin.edit.updatestatus');
        Route::post('/xoamotsptrongbill/{id}', [BillController::class, 'destroyOne'])->name('admin.deleteDetail.bill');
        
        // Route::post('/capnhattrangthai', [BillController::class, 'edit'])->name('admin.edit.sanpham');

    });
    
    Route::group(['prefix'=>'thongke'], function (){
        Route::get('/', [BillController::class, 'statistic'])->name('admin.revenue');
    });

    //
    Route::group(['prefix'=>'quanlybaiviet'], function (){
        Route::get('/', [BlogController::class, 'index'])->name('admin.blog');
        Route::get('/taomoibaiviet', [BlogController::class, 'create'])->name('admin.add.blog');
        Route::post('/xoabaiviet/{id}', [BlogController::class, 'destroy'])->name('admin.delete.blog');
        Route::post('/taomoibaiviet/storebaiviet', [BlogController::class, 'storeBlog'])->name('admin.add.storeblog');
        Route::get('/{id}/suabaiviet', [BlogController::class, 'edit'])->name('admin.edit.blog');
        Route::post('/{id}/suabaiviet/updatebaiviet', [BlogController::class, 'update'])->name('admin.edit.updateblog');
        Route::get('/commentdetail/{id}', [BlogController::class, 'showDetailAdmin'])->name('admin.detail.comment');
        Route::post('/xoacomment/{id}', [BlogController::class, 'destroyComment'])->name('admin.delete.comment');

    });
    
});




// ĐĂNG KÝ
// Route::get('/sigin',[AccountController::class, 'create'])->name('sigin');
Route::post('/store',[AccountController::class, 'store'])->name('store');

// Đăng nhập
Route::post('/getLogin',[AccountController::class, 'getLogin'])->name('getLogin');

// Đăng xuất
Route::get('/logout',[AccountController::class, 'logout'])->name('logout');
  
// Tài khoản
Route::middleware('auth:sanctum')->group(function () {
    // Các tuyến đường yêu cầu xác thực ở đây
    Route::get('/user', function () {
        return auth()->user();
    });
});

// Đổi mật khẩu
Route::post('/user/{id}/change-password',[AccountController::class, 'change'])->name('user.changePass');
Route::post('/user/{id}/updateuser',[AccountController::class, 'updateuser'])->name('user.updateuser');
// Route::get('/search', [SanPhamController::class, 'indexShopCho'])->name('search');


// Route::get('/view', [UserController::class, 'view1'])->name('accountuser.view');

Route::get('/', [UserController::class, 'view'])->name('user.view');
Route::get('/login', [UserController::class, 'login'])->name('login.view');
Route::get('/sigin', [UserController::class, 'sigin'])->name('sigin.view');
Route::get('/account', [UserController::class, 'account'])->name('account.view')->middleware('auth');
Route::get('/changepass', [UserController::class, 'changepass'])->name('changepass.view');
Route::get('/editprofile', [UserController::class, 'editprofile'])->name('editprofile.view');
// Route::get('/contact', [UserController::class, 'contact'])->name('contact.view');
Route::get('/contact', [ContactController::class, 'getContract'])->name('contact.view');
Route::post('/contact', [ContactController::class, 'postEmail']);

Route::group(['prefix'=>'homeuser'], function (){
    // SHOP CHO
    Route::group(['prefix'=>'shopcho'], function (){
        Route::group(['prefix'=>'shopchota'], function (){
            Route::get('/', [SanPhamController::class, 'indexShopCho'])->name('shopchota.view'); // THỨC ĂN cho
            Route::get('/search', [SanPhamController::class, 'searchTAC'])->name('searchTAC.view'); // ĐỒ CHƠI cho
            // CHI TIẾT 1 MẶT HÀNG
            // Route::get('/infosp/{id}', [SanPhamController::class, 'indexOne'])->name('infosp.view');//khi click vô 1 mặt hàng thì hiện ra thông tin sản phẩm đó
            // Route::get('/addsptocart/{id}', [CartController::class, 'addSPToCart'])->name('addsptocart.view')->middleware('cart');
        });

        Route::group(['prefix'=>'shopchoqa'], function (){
            Route::get('/', [SanPhamController::class, 'indexShopChoQA'])->name('shopchoqa.view'); // THỨC ĂN cho
            Route::get('/search', [SanPhamController::class, 'searchQAC'])->name('searchQAC.view'); // ĐỒ CHƠI cho
        });

        Route::group(['prefix'=>'shopchodc'], function (){
            Route::get('/', [SanPhamController::class, 'indexShopChoDC'])->name('shopchodc.view'); // THỨC ĂN cho
            Route::get('/search', [SanPhamController::class, 'searchDCC'])->name('searchDCC.view'); // ĐỒ CHƠI cho
        });
    });
    

    // SHOP MÈO
    Route::group(['prefix'=>'shopmeo'], function (){
        Route::group(['prefix'=>'shopmeota'], function (){
            Route::get('/', [SanPhamController::class, 'indexShopMeo'])->name('shopmeota.view'); // THỨC Ămeo
            Route::get('/search', [SanPhamController::class, 'searchTAM'])->name('searchTAM.view'); // ĐỒ CHƠI cho
        });

        Route::group(['prefix'=>'shopmeoqa'], function (){
            Route::get('/', [SanPhamController::class, 'indexShopMeoQA'])->name('shopmeoqa.view'); // THỨC ĂN cho
            Route::get('/search', [SanPhamController::class, 'searchQAM'])->name('searchQAM.view'); // ĐỒ CHƠI cho
        });

        Route::group(['prefix'=>'shopmeodc'], function (){
            Route::get('/', [SanPhamController::class, 'indexShopMeoDC'])->name('shopmeodc.view'); // THỨC ĂN cho
            Route::get('/search', [SanPhamController::class, 'searchDCM'])->name('searchDCM.view'); // ĐỒ CHƠI cho
        });
    });
    
    // SHOP CHIM
    Route::group(['prefix'=>'shopchim'], function (){
        Route::get('/', [SanPhamController::class, 'indexShopChim'])->name('shopchim.view'); // THỨC ĂN cho
        Route::get('/search', [SanPhamController::class, 'searchCI'])->name('searchCI.view'); // ĐỒ CHƠI cho
        
    });
    // SHOP CHUỘT
    Route::group(['prefix'=>'shopchuot'], function (){
        Route::get('/', [SanPhamController::class, 'indexShopChuot'])->name('shopchuot.view'); // THỨC ĂN cho
        Route::get('/search', [SanPhamController::class, 'searchCU'])->name('searchCU.view'); // ĐỒ CHƠI cho
        
    });
    // SHOP CÁ
    Route::group(['prefix'=>'shopca'], function (){
        Route::get('/', [SanPhamController::class, 'indexShopCa'])->name('shopca.view'); // THỨC ĂN cho
        Route::get('/search', [SanPhamController::class, 'searchCA'])->name('searchCA.view'); // ĐỒ CHƠI cho
        
    });
    
    // GIỎ HÀNG
    Route::group(['prefix'=>'cart', 'middleware' => 'cart'], function (){
        Route::get('/', [CartController::class, 'index'])->name('cart.view')->middleware('cart');
        Route::post('/deletesptocart/{id}', [CartController::class, 'destroy'])->name('deletesptocart.view');  
        Route::post('/buy', [BillController::class, 'buy'])->name('buy.view');
        Route::get('/addsptocart/{id}', [CartController::class, 'addSPToCart'])->name('addsptocart.view')->middleware('cart');
    });

    // ĐƠN HÀNG
    Route::group(['prefix'=>'order', 'middleware' => ['auth', 'cart']], function (){
        Route::get('/', [BillController::class, 'indexUser'])->name('order.view')->middleware('auth');
        Route::get('/orderdetail/{id}', [BillController::class, 'showDetail'])->name('orderdetail.view');
        // Route::post('/buy', [BillController::class, 'buy'])->name('buy.view');
    });

    // REVIEW
    Route::group(['prefix'=>'blogcho'], function (){
        Route::get('/', [BlogController::class, 'indexBlogCho'])->name('blogcho.view');// review cho
        Route::get('/search', [BlogController::class, 'searchBC'])->name('searchBC.view');

    });

    Route::group(['prefix'=>'blogmeo'], function (){
        Route::get('/', [BlogController::class, 'indexBlogMeo'])->name('blogmeo.view');// review cho
        Route::get('/search', [BlogController::class, 'searchBM'])->name('searchBM.view');

    });

    Route::group(['prefix'=>'blogchim'], function (){
        Route::get('/', [BlogController::class, 'indexBlogChim'])->name('blogchim.view');// review cho
        Route::get('/search', [BlogController::class, 'searchBCI'])->name('searchBCI.view');

    });

    Route::group(['prefix'=>'blogchuot'], function (){
        Route::get('/', [BlogController::class, 'indexBlogChuot'])->name('blogchuot.view');// review cho
        Route::get('/search', [BlogController::class, 'searchBCU'])->name('searchBCU.view');

    });

    Route::group(['prefix'=>'blogca'], function (){
        Route::get('/', [BlogController::class, 'indexBlogCa'])->name('blogca.view');// review cho
        Route::get('/search', [BlogController::class, 'searchBCA'])->name('searchBCA.view');

    });

    // BÌNH LUẬN
    Route::group(['prefix'=>'binhluan', 'middleware' => 'auth'], function (){
        Route::post('/{id}', [BlogController::class, 'addComment'])->name('comment.view');
        Route::post('/update/{id}', [BlogController::class, 'updateComment'])->name('update.comment.view');
        Route::post('/delete/{id}', [BlogController::class, 'destroyComment'])->name('delete.comment.view');
        
    });
    
    // CHI TIẾT
    Route::group(['prefix'=>'detail'], function (){
        Route::get('/infosp/{id}', [SanPhamController::class, 'indexOne'])->name('infosp.view');//khi click vô 1 mặt hàng thì hiện ra thông tin sản phẩm đó
        Route::get('/reviewchitiet/{id}', [BlogController::class, 'indexReview'])->name('reviewchitiet.view');//review chi tiết 1 loài, vd giốngchó alaska
    
    });
    
});


// CHI TIẾT REVIEW
// Route::get('/reviewchitiet', [UserController::class, 'reviewchitiet'])->name('reviewchitiet.view');//review chi tiết 1 loài, vd giốngchó alaska