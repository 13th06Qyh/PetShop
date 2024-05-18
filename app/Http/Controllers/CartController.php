<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CartServices;
use Illuminate\Http\RedirectResponse;
class CartController extends Controller
{
    private CartServices $cart;

    public function __construct(CartServices $cart){
        $this->cart = $cart;
    }

    public function index(){
        $carts = $this->cart->getAll();
        $cartid = $this->cart->deleteOutOfStockItems();
        return view ('user.pages.cart', compact('carts'));
    }

    public function addSPToCart($id){
        $cartSL = $this->cart->checkKho($id);
        // dd($cartSL);
        if ($cartSL >= 1){
            $cartC = $this->cart->check($id);
            // dd($cartC);
            if(!$cartC){
                $cart = $this->cart->add($id);
                session()->flash('error', 'Đã thành công thêm vào giỏ hàng.');
                return redirect()->route('infosp.view', ['id' => $id]);
            }
            else{
                session()->flash('error', 'Sản phẩm đã có trong giỏ hàng!');
                return redirect()->back()->withInput();
            }
        }
        else{
            $de = $this->cart->deleteKho($id);
            session()->flash('error', 'Xin lỗi bạn, hiện tại sản phẩm đang hết hàng, hãy quay trở lại sau!');
            return redirect()->back()->withInput();
        }
        
    }

    public function destroy($id): RedirectResponse
    {
        $this->cart->delete($id);
        return redirect()->route('cart.view');
    }


    // public function buy(Request $request)
    // {
    //     // $cartt = $request->get('carts');
    //     // dd($cartt);
        
    //     $carts = $this->cart->buy($request);
    //     // dd($carts);
    //     session()->flash('error', 'Đã đặt hàng thành công!');
    //     // return redirect()->route('order.view');
    //     return view('user.pages.showbill', compact('carts'));
    // }
    
}