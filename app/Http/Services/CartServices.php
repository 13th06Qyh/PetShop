<?php

namespace App\Http\Services;

use App\Models\SanPham;
use App\Models\Cart;
use App\Models\User;
use App\Models\Bill;
use App\Models\Bill_SP;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartServices {
    private SanPham $sanpham;
    private Cart $cart;
    private User $user;
    private Bill $bill;
    private Bill_SP $bill_sp;

    public function __construct(SanPham $sanpham, Cart $cart, User $user, Bill $bill, Bill_SP $bill_sp)
    {
        $this->sanpham = $sanpham;
        $this->cart = $cart;
        $this->user = $user;
        $this->bill = $bill;
        $this->bill_sp = $bill_sp;
    }

    public function findOne($id)
    {
        return $this->cart->find($id);
    }
    
    //get All Cart
    public function getAll(): Collection {

        return $this->sanpham->join('cart', 'sanpham.maSP', '=', 'cart.idsp')->where('cart.iduser', auth()->user()->id)->get();
    }

    public function deleteOutOfStockItems() {
        // Bước 1: Lấy danh sách sản phẩm có số lượng nhỏ hơn 1
        $outOfStockItems = $this->sanpham
            ->join('cart', 'sanpham.maSP', '=', 'cart.idsp')
            ->where('cart.iduser', auth()->user()->id)
            ->where('sanpham.soluongkho', '<', 1)
            ->select('cart.idsp as cart_idsp')
            ->get();
    
        // Bước 2: Xóa các sản phẩm có số lượng nhỏ hơn 1 khỏi giỏ hàng
        foreach ($outOfStockItems as $item) {
            $this->cart->where('idsp', $item->cart_idsp)->delete();
        }
    }
    
    

    //add cart
    public function add($id){
        $new = new Cart([
            'idsp' => $id,
            'iduser' => auth()->user()->id
        ]);
        return $new->save();
    }

    public function check($id){
        return $this->cart->where('idsp', 'like', '%'.$id.'%')
                          ->where('iduser', 'like', '%'.auth()->user()->id.'%')
                          ->get()
                          ->isNotEmpty();
    }

    public function checkKho($id){
        return $this->sanpham->find($id)->soluongkho;
    }

    public function deleteKho($id){
        $item = $this->cart->where('idsp', $id)->first();
        // \dd($item);
            if ($item){
                $item->delete();
        }
        
    }
    public function delete($id){
        $item = $this->findOne($id);
            if ($item){
                $item->delete();
        }
        
    }


    

//     public function buy($request)
// {
//     $new = new Bill([
//         'iduser' => auth()->user()->id,
//         'diachi' => $request->address,
//         'status' => 'Chưa thanh toán',
//     ]);
//     $new->save();

//     // Lấy ID của đơn hàng mới tạo
//     $newId = $new->maBill;
//     $cartt = $request->carts;
//     $totalAmount = 0;

//     if ($cartt !== null) {
//         foreach ($cartt as $cart) {
//             // Add a check for $cart['check']
//             if (isset($cart['check']) && $cart['check'] == 1) {
//                 $itemBS = new Bill_SP([
//                     'idbill' => $newId,
//                     'idsp' => $cart['id'],
//                     'soluong' => $cart['quantity'],
//                 ]);
//                 // dd($itemBS);
//                 $itemSP = $this->sanpham->find($cart['id']);
//                 $itemSP->decrement('soluongkho', $cart['quantity']);
//                 $itemBS->save();
//                 $subtotal = $itemSP->buyprice * $cart['quantity'];
//                 $totalAmount += $subtotal;


                

//             }
//         }
//         return $totalAmount;
//     }
// }

    
}


    