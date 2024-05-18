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
use Carbon\Carbon;


class BillServices {
    private Bill $bill;
    private SanPham $sanpham;
    private Cart $cart;
    private User $user;
    private Bill_SP $bill_sp;


    public function __construct(Bill $bill, SanPham $sanpham, Cart $cart, User $user, Bill_SP $bill_sp)
    {
        $this->bill = $bill;
        $this->sanpham = $sanpham;
        $this->cart = $cart;
        $this->user = $user;
        $this->bill_sp = $bill_sp;
    }

    public function findOne($id)
    {
        return $this->bill->find($id);
    }
    
    //get All Cart
    public function getAll(): Collection {
        return $this->bill->all();
    }

    public function getAllBilltoUser() {
        // select * from animal where id = 1 and idtype = 2
        return $this->bill->where('iduser', auth()->user()->id)->get();
    }

    public function getAllBill_SPtoUser($id) {
        // select * from bill_sp where idbill = 'id'
        return $this->bill_sp->where('idbill', $id)->get(); 
    }

    public function buy($request)
    {
        $mes = 0;
        $mes2 = 1;
        $new = new Bill([
            'iduser' => auth()->user()->id,
            'diachi' => $request->address,
            'status' => 'Chưa thanh toán',
        ]);

        $cartt = $request->carts;
        // \dd($cartt);
        if ($cartt !== null) {
            foreach ($cartt as $cart) {
                // \dd($cart);
                if (isset($cart['check']) && $cart['check'] == 1) {
                    // \dd($cart['id']);
                    $itemSP = $this->sanpham->find($cart['id']);
                    // \dd($itemSP);
                    // \dd($itemSP->soluongkho);
                        if ($itemSP->soluongkho >= $cart['quantity']) {
                            $new->save();
                            $newId = $new->maBill;
                            $itemBS = new Bill_SP([
                                'idbill' => $newId,
                                'idsp' => $cart['id'],
                                'soluong' => $cart['quantity'],
                            ]);
                            $itemSP->decrement('soluongkho', $cart['quantity']);
                            $itemBS->save();
                            // return $mes;

                        }
                        else {
                            return $mes2;
                        }
                }
            }
        }
    }

    public function total2()
    {
        // Lấy các thông tin cần thiết từ bảng bill_sp và group theo idbill
        $groupedProducts = Bill_SP::select('idbill', 'idsp', 'soluong')->get()
            ->groupBy('idbill');
        // dd($groupedProducts);
        // Lưu tổng tiền của từng bill
        $totals = [];

        // Lặp qua từng sản phẩm có cùng idbill
        foreach ($groupedProducts as $groupedProduct) {
            $totalAmount = 0; // Đặt totalAmount về 0 cho mỗi bill mới
            // dd($groupedProduct);
            foreach ($groupedProduct as $product) {
                // dd($product);
                $idsp = $product->idsp;
                // dd($idsp);
                $soluong = $product->soluong;
                // dd($soluong);

                // Lấy thông tin sản phẩm
                $itemSP = $this->sanpham->find($idsp);
                // dd($itemSP);

                if ($itemSP) {
                    // Tính tổng tiền cho sản phẩm hiện tại
                    $price = $itemSP->buyprice;
                    // dd($price);
                    $subtotal = $price * $soluong;
                    // dd($subtotal);

                    // Cộng tổng tiền vào biến totalAmount cho sản phẩm hiện tại
                    $totalAmount += $subtotal;
                    // dd($totalAmount);
                }
            }
            // dd($totalAmount);
            // Lưu tổng tiền của bill vào mảng $totals
            $totals[$groupedProduct->first()->idbill] = $totalAmount;
            // dd($totals);
        }

        // dd($totals);
        return $totals;
    }

    public function update($id, $request){
        $bills = $this->findOne($id);
        $bills->status = $request->status_tt;
        return $bills->update();
    }

    public function delete($id) {
        $bills = $this->findOne($id);
        // $cancellationDeadline = now()->subWeek(); // Giả sử hạn chót là 1 tuần trước thời điểm hiện tại

        // if ($bills->created_at <= $cancellationDeadline) {
        //     return false;
        // }
        $bills->status = 'Đã huỷ';
        return $bills->update();
    }

    public function deleteDetailOne($id) {
        $mes = 0;
        $mes1 = 1;
        $billTT = $this->bill->join('bill_sp', 'bill.maBill', '=', 'bill_sp.idbill')
                            ->where('bill_sp.maBillSP', $id)
                            ->where('bill.status', 'Đã thanh toán')
                            ->first();
                            // \dd($billTT);
        $bill_sps = $this->bill_sp->find($id);
        // \dd($bill_sps->idbill);
        if ($bill_sps) {
            $bills = $this->findOne($bill_sps->idbill);
            // \dd($bills);
            $date = $bills->created_at;
            $current_time = now();
            if ($current_time->diffInHours($date) > 12) {
                // Không cho phép hủy đơn hàng
                return false;
            }
            elseif ($billTT) {
                return $mes1;
            }
             else {
                
                $billSpCount = $this->bill_sp->where('idbill', $bills->maBill)->count();
                // \dd($billSpCount);
                $product = $this->sanpham->find($bill_sps->idsp);
                $product->increment('soluongkho', $bill_sps->soluong);
                $product->save();
                if ($billSpCount == 1) {
                    // Nếu số lượng bill_sp của bill hiện tại bằng 0, xóa cả bill
                    $bills->update(['status' => 'Đã hủy']);
                    $bills->save();
                    
                } else {
                    // Nếu có nhiều hơn 1 bill_sp, chỉ cập nhật updated_at của bill
                    $bill_sps->delete();
                    $bills->update(['updated_at' => $current_time]);
                    $bills->save();
                }
        
                return true;
            }
            
        }
        return false;
    
        
    }

    public function check($id) {
        $bills = $this->bill->where('maBill', $id)->where('status', 'Đã hủy')->first();
        // \dd($bills);
        if ($bills) {
            return true;
        }
        return false;
            
        
    }

    public function checkD($id) {
        $bills = $this->bill->join('bill_sp', 'bill.maBill', '=', 'bill_sp.idbill')
                            ->where('bill_sp.maBillSP', $id)
                            ->where('bill.status', 'Đã hủy')
                            ->first();
        // \dd($bills);
        if ($bills) {
            return true;
        }
        return false;
            
        
    }

   public function revenue() {
       return $bills = $this->bill->where('status', 'Đã thanh toán')->get();
       
   }
   
   public function total1($request) {
        $month = $request->input('month');
        $year = $request->input('year');
        $bill_sp = $this->sanpham->join('bill_sp', 'sanpham.maSP', '=', 'bill_sp.idsp')
                                 ->join('bill', 'bill_sp.idbill', '=', 'bill.maBill')
                                 ->where('sanpham.idanimal', '1')
                                 ->where('bill.status', 'Đã thanh toán');
                                 if ($month) {
                                    $bill_sp->whereMonth('bill_sp.created_at', $month);
                                }
                            
                                if ($year) {
                                    $bill_sp->whereYear('bill_sp.created_at', $year);
                                }    
                                $bill_sps = $bill_sp->select('bill_sp.maBillSP as bill_sp_maBSP', 'bill_sp.idbill as bill_sp_idbill', 'bill_sp.idsp as bill_sp_idsp', 'bill_sp.soluong as bill_sp_soluong')
                                 ->get();
                                 
                                //  \dd($bill_sps);
        if ($bill_sps) {
            $totals = [];
            $totalAmount = 0;
            foreach ($bill_sps as $bill_sp) {
                $idsp = $bill_sp->bill_sp_idsp;
                // dd($idsp);
                $soluong = $bill_sp->bill_sp_soluong;
                // dd($soluong);
                $itemSP = $this->sanpham->find($idsp);
                // dd($itemSP);

                if ($itemSP) {
                    $price = $itemSP->buyprice;
                    // dd($price);
                    $subtotal = $price * $soluong;
                    // dd($subtotal);
                    $totalAmount += $subtotal;
                    // dd($totalAmount);
                }   
                $totals[$bill_sp->first()->maBillSP] = $totalAmount;
            }
            // dd($totalAmount);
           
            // dd($totals);

            // dd($totals);
            return $totalAmount;
        }                        
        
   }

   public function total3($request) {
        $month = $request->input('month');
        $year = $request->input('year');
        $bill_sp = $this->sanpham->join('bill_sp', 'sanpham.maSP', '=', 'bill_sp.idsp')
                                ->join('bill', 'bill_sp.idbill', '=', 'bill.maBill')
                                ->where('sanpham.idanimal', '2')
                                ->where('bill.status', 'Đã thanh toán');
                                if ($month) {
                                    $bill_sp->whereMonth('bill_sp.created_at', $month);
                                }
                            
                                if ($year) {
                                    $bill_sp->whereYear('bill_sp.created_at', $year);
                                }
                                $bill_sps = $bill_sp->select('bill_sp.maBillSP as bill_sp_maBSP', 'bill_sp.idbill as bill_sp_idbill', 'bill_sp.idsp as bill_sp_idsp', 'bill_sp.soluong as bill_sp_soluong')
                                ->get();
                                //  \dd($bill_sps);
        if ($bill_sps) {
            $totals = [];
            $totalAmount = 0;
            foreach ($bill_sps as $bill_sp) {
                $idsp = $bill_sp->bill_sp_idsp;
                // dd($idsp);
                $soluong = $bill_sp->bill_sp_soluong;
                // dd($soluong);
                $itemSP = $this->sanpham->find($idsp);
                // dd($itemSP);

                if ($itemSP) {
                    $price = $itemSP->buyprice;
                    // dd($price);
                    $subtotal = $price * $soluong;
                    // dd($subtotal);
                    $totalAmount += $subtotal;
                    // dd($totalAmount);
                }  
                $totals[$bill_sp->first()->maBillSP] = $totalAmount; 
            }
            // dd($totalAmount);
            
            // dd($totals);

            // dd($totals);
            return $totalAmount;
        } 
        return false;                       
        
   }

    public function total4($request) {
        $month = $request->input('month');
        $year = $request->input('year');
        $bill_sp = $this->sanpham->join('bill_sp', 'sanpham.maSP', '=', 'bill_sp.idsp')
                                ->join('bill', 'bill_sp.idbill', '=', 'bill.maBill')
                                ->where('sanpham.idanimal', '3')
                                ->where('bill.status', 'Đã thanh toán');
                                if ($month) {
                                    $bill_sp->whereMonth('bill_sp.created_at', $month);
                                }
                            
                                if ($year) {
                                    $bill_sp->whereYear('bill_sp.created_at', $year);
                                }
                                $bill_sps = $bill_sp->select('bill_sp.maBillSP as bill_sp_maBSP', 'bill_sp.idbill as bill_sp_idbill', 'bill_sp.idsp as bill_sp_idsp', 'bill_sp.soluong as bill_sp_soluong')
                                ->get();
                                //  \dd($bill_sps);
        if ($bill_sps) {
            $totals = [];
            $totalAmount = 0;
            foreach ($bill_sps as $bill_sp) {
                $idsp = $bill_sp->bill_sp_idsp;
                // dd($idsp);
                $soluong = $bill_sp->bill_sp_soluong;
                // dd($soluong);
                $itemSP = $this->sanpham->find($idsp);
                // dd($itemSP);

                if ($itemSP) {
                    $price = $itemSP->buyprice;
                    // dd($price);
                    $subtotal = $price * $soluong;
                    // dd($subtotal);
                    $totalAmount += $subtotal;
                    // dd($totalAmount);
                }  
                $totals[$bill_sp->first()->maBillSP] = $totalAmount; 
            }
            // dd($totalAmount);
            // dd($totals);

            // dd($totals);
            return $totalAmount;
        }
        return false;                        
        
   }

    public function total5($request) {
        $month = $request->input('month');
        $year = $request->input('year');
        $bill_sp = $this->sanpham->join('bill_sp', 'sanpham.maSP', '=', 'bill_sp.idsp')
                                ->join('bill', 'bill_sp.idbill', '=', 'bill.maBill')
                                ->where('sanpham.idanimal', '4')
                                ->where('bill.status', 'Đã thanh toán');
                                if ($month) {
                                    $bill_sp->whereMonth('bill_sp.created_at', $month);
                                }
                            
                                if ($year) {
                                    $bill_sp->whereYear('bill_sp.created_at', $year);
                                }
                                $bill_sps = $bill_sp->select('bill_sp.maBillSP as bill_sp_maBSP', 'bill_sp.idbill as bill_sp_idbill', 'bill_sp.idsp as bill_sp_idsp', 'bill_sp.soluong as bill_sp_soluong')
                                ->get();
                                //  \dd($bill_sps);
        if ($bill_sps) {
            $totals = [];
            $totalAmount = 0;
            foreach ($bill_sps as $bill_sp) {
                $idsp = $bill_sp->bill_sp_idsp;
                // dd($idsp);
                $soluong = $bill_sp->bill_sp_soluong;
                // dd($soluong);
                $itemSP = $this->sanpham->find($idsp);
                // dd($itemSP);

                if ($itemSP) {
                    $price = $itemSP->buyprice;
                    // dd($price);
                    $subtotal = $price * $soluong;
                    // dd($subtotal);
                    $totalAmount += $subtotal;
                    // dd($totalAmount);
                } 
                $totals[$bill_sp->first()->maBillSP] = $totalAmount;  
            }
            // dd($totalAmount);
            // dd($totals);

            // dd($totals);
            return $totalAmount;
        }
        return false;                        
        
   }

    public function total6($request) {
        $month = $request->input('month');
        $year = $request->input('year');
        $bill_sp = $this->sanpham->join('bill_sp', 'sanpham.maSP', '=', 'bill_sp.idsp')
                                ->join('bill', 'bill_sp.idbill', '=', 'bill.maBill')
                                ->where('sanpham.idanimal', '5')
                                ->where('bill.status', 'Đã thanh toán');
                                if ($month) {
                                    $bill_sp->whereMonth('bill_sp.created_at', $month);
                                }
                            
                                if ($year) {
                                    $bill_sp->whereYear('bill_sp.created_at', $year);
                                }
                                $bill_sps = $bill_sp->select('bill_sp.maBillSP as bill_sp_maBSP', 'bill_sp.idbill as bill_sp_idbill', 'bill_sp.idsp as bill_sp_idsp', 'bill_sp.soluong as bill_sp_soluong')
                                ->get();
                                //  \dd($bill_sps);
        if ($bill_sps) {
            $totals = [];
            $totalAmount = 0;
            foreach ($bill_sps as $bill_sp) {
                $idsp = $bill_sp->bill_sp_idsp;
                // dd($idsp);
                $soluong = $bill_sp->bill_sp_soluong;
                // dd($soluong);
                $itemSP = $this->sanpham->find($idsp);
                // dd($itemSP);

                if ($itemSP) {
                    $price = $itemSP->buyprice;
                    // dd($price);
                    $subtotal = $price * $soluong;
                    // dd($subtotal);
                    $totalAmount += $subtotal;
                    // dd($totalAmount);
                }   
                $totals[$bill_sp->first()->maBillSP] = $totalAmount;
            }
            // dd($totalAmount);
            // dd($totals);

            // dd($totals);
            return $totalAmount;
        }  
        return false;                      
        
   }


    

    

 
}


    