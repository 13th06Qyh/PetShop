<?php
namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    private User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function view() {
        return view('user.pages.index');
    }

    public function login() {
        return view('user.pages.login');
    }

    public function sigin() {
        return view('user.pages.sigin');
    }

    public function account() {
        return view('user.pages.account');
    }

    public function changepass() {
        return view('user.pages.changepass');
    }

    public function editprofile() {
        return view('user.pages.editprofile');
    }
    
    public function shopchota() {
        return view('user.pages.shopchota');//THỨC ĂN cho
    }

    public function shopchoqa() {
        return view('user.pages.shopchoqa');//QUẦN ÁO cho
    }

    public function shopchodc() {
        return view('user.pages.shopchodc');//ĐỒ CHƠI cho
    }

    public function shopmeota() {
        return view('user.pages.shopmeota');//THỨC ĂN meomeomeo
    }

    public function shopmeoqa() {
        return view('user.pages.shopmeoqa');//QUẦN ÁO meomeomeo
    }

    public function shopmeodc() {
        return view('user.pages.shopmeodc');//ĐỒ CHƠI meomeomeo
    }

    public function shopchim() {
        return view('user.pages.shopchim');//SHOP CHIM
    }

    public function shopchuot() {
        return view('user.pages.shopchuot');//SHOP CHUOT
    }

    public function shopca() {
        return view('user.pages.shopca');//SHOP CA
    }

    public function cart() {
        return view('user.pages.cart');
    }

    public function contact() {
        return view('user.pages.contact');
    }

    public function blogcho() {
        return view('user.pages.blogcho');// review cho
    }

    public function blogmeo() {
        return view('user.pages.blogmeo');// review meomeomeo
    }

    public function blogchim() {
        return view('user.pages.blogchim');// review chim
    }

    public function blogchuot() {
        return view('user.pages.blogchuot');// review chuot
    }

    public function blogca() {
        return view('user.pages.blogca');// review ca
    }

    public function reviewchitiet() {
        return view('user.pages.reviewchitiet');// review chi tiết 1 loài, ví dụ review chi tiết giống chó alaska... 
    }

    public function infosp() {
        return view('user.pages.infosp');// khi click vô 1 mặt hàng thì hiện ra đầy đủ thông tin sản phẩm đó
    }
    
    



    
    
    
    public function view2() {
        return view('admin.pages.addsanpham');
    }
    public function view3() {
        return view('admin.pages.adminQLsanpham');
    }
    public function view4() {
        return view('admin.pages.adminQLbill');
    }


    

    
    

}