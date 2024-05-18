<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Bill_SPServices;
use Illuminate\Http\RedirectResponse;
class Bill_SPController extends Controller
{
    private Bill_SPServices $billsp;

    public function __construct(Bill_SPServices $bill){
        $this->billsp = $billsp;
    }

    public function showDetail($id){
        $billD = $this->billsp->findOne($id);
        return view('user.pages.showdetailbill', compact('billD'));
    }

    
}