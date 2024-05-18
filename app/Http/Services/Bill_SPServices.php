<?php

namespace App\Http\Services;

use App\Models\SanPham;
use App\Models\Bill;
use App\Models\Bill_SP;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class BillServices {
    private Bill $bill;
    private SanPham $sanpham;
    private Bill_SP $bill_sp;


    public function __construct(Bill $bill, SanPham $sanpham, Bill_SP $bill_sp)
    {
        $this->bill = $bill;
        $this->sanpham = $sanpham;
        $this->bill_sp = $bill_sp;

    }

    public function findOne($id)
    {
        return $this->bill_sp->find($id);
    }
 
}


    