<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\BillServices;
use Illuminate\Http\RedirectResponse;
class BillController extends Controller
{
    private BillServices $bill;

    public function __construct(BillServices $bill){
        $this->bill = $bill;
    }

    public function index(){
        $bills = $this->bill->getAll();
        $billDArray = $this->bill->total2();
        return view ('admin.pages.adminQLbill', compact('bills', 'billDArray'));
    }

    public function indexUser(Request $request){
        $bills = $this->bill->getAllBilltoUser();
        $billDArray = $this->bill->total2();
        return view ('user.pages.showbill', compact('bills', 'billDArray'));
    }

    public function buy(Request $request): RedirectResponse{
        $bills = $this->bill->getAllBilltoUser();
        $carts = $this->bill->buy($request);
        // \dd($carts);
        if ($carts == 1){
            session()->flash('error', 'Xin lỗi bạn! Có một số sản phẩm không có đủ số lượng hàng để mua! Vui lòng xem lại!');
            return redirect()->back()->withInput();
        }
        // dd($carts);
        $billDArray = $this->bill->total2();
        // \dd($billDArray);

        return redirect()->route('order.view')->with('bills', 'carts', 'billDArray');
        // return view ('user.pages.showbill', compact('bills', 'carts', 'billDArray'));
    }
    

    public function showDetail($id){
        $bills = $this->bill->findOne($id);
        $billD = $this->bill->getAllBill_SPtoUser($id);
        return view('user.pages.showdetailbill', compact('billD', 'bills'));
    }

    public function showDetailAdmin($id){
        $bills = $this->bill->findOne($id);
        $billD = $this->bill->getAllBill_SPtoUser($id);
        return view('admin.pages.adminDetailBill', compact('billD', 'bills'));
    }

    public function update($id, Request $request){
        $check = $this->bill->check($id);
        // \dd($check);
        if ($check == true){
            session ()->flash('error', 'Không thể thay đổi đơn hàng với trạng thái bị hủy!');
            return redirect()->back()->withInput();
        }
        else {
            $this->bill->update($id, $request);
            return redirect()->route('admin.bill');
        }
        
    }

    public function destroy($id){
        $check = $this->bill->check($id);
        // \dd($check);
        if ($check == true){ 
            session ()->flash('error', 'Không thể tiếp tục hủy đơn hàng vì đơn hàng đã hủy!');
            return redirect()->back()->withInput();
        }
        else {
            $this->bill->delete($id);
            return redirect()->route('admin.bill');
        }
        
    }

    public function destroyOne($id){
        $check = $this->bill->checkD($id);
        // dd($check);
        if ($check == true) {
            session ()->flash('error', 'Không thể xóa sản phẩm vì đơn hàng đã bị hủy!');
            return redirect()->back()->withInput();
        }
        else {
            $bills = $this->bill->deleteDetailOne($id);
            // dd($bills);
            if ($bills == false){ 
                session ()->flash('error', 'Không thể hủy sản phẩm trong đơn hàng sau 12 tiếng!');
                return redirect()->back()->withInput();
            }
            else if ($bills === 1){
                session ()->flash('error', 'Không hủy sản phẩm trong đơn hàng đã thanh toán!');
                return redirect()->back()->withInput();
            }
            else {
                session ()->flash('success', 'Sản phẩm đã được xóa khỏi đơn hàng!');
                return redirect()->back()->withInput();
            }
        }
        
    }

    public function statistic(Request $request){
        $revenues = $this->bill->revenue();
        $billDArray = $this->bill->total2();
        $billDAC = $this->bill->total1($request);
        // \dd($billDAC);
        $billDAM = $this->bill->total3($request);
        // \dd($billDAM);
        $billDACI = $this->bill->total4($request);
        $billDACU = $this->bill->total5($request);
        $billDACA = $this->bill->total6($request);

        $month = $request->input('month');
        $year = $request->input('year');
        // \dd($month, $year);
        
        // \dd($billDA);
        return view('admin.pages.adminRevenue', compact('revenues', 'billDArray', 'billDAC', 'billDAM', 'billDACI', 'billDACU', 'billDACA', 'month', 'year'));
        
    }
    

    
}