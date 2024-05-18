<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\SanPhamServices;
use App\Models\SanPham;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private SanPhamServices $sanpham;
    public function __construct(SanPhamServices $sanpham){
        $this->sanpham = $sanpham;
    }
     public function index(){
        $sanphams = $this->sanpham->getAll();
        $tags = $this->sanpham->getAllTag();
        $types = $this->sanpham->getAllType();
        $animals = $this->sanpham->getAllAnimal();
        $provides = $this->sanpham->getAllProvide();
        return response()->json(
            [
                'sanphams' => $sanphams,
                'tags' => $tags,
                'types' => $types,
                'animals' => $animals,
                'provides' => $provides
            ]
            );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}