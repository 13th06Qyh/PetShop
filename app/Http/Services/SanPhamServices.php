<?php

namespace App\Http\Services;

use App\Models\SanPham;
use App\Models\Tag;
use App\Models\Type;
use App\Models\Animal;
use App\Models\Provide;
use App\Models\ImageSP;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Sanphamservices {
    private SanPham $sanpham;
    private Tag $tag;
    private Type $type;
    private Animal $animal;
    private Provide $provide;
    private ImageSP $imageSP;

    public function __construct(SanPham $sanpham, Tag $tag, Type $type, Animal $animal, Provide $provide)
    {
        $this->sanpham = $sanpham;
        $this->tag = $tag;
        $this->type = $type;
        $this->animal = $animal;
        $this->provide = $provide;
    }

    public function getAll(): Collection {
        return $this->sanpham->all();
    }

    public function getAllPaginate()
    {
        return $this->sanpham->paginate(3);
    }

    public function findOne($id)
    {
        return $this->sanpham->find($id);
    }

    // create function get all tag
    public function getAllTag(): Collection {
        // select * from tag
        return $this->tag->all();
    }

    // create function get all type
    public function getAllType(): Collection {
        return $this->type->all();
    }

    // create function get all animal
    public function getAllAnimal(): Collection {
        return $this->animal->all();
    }

    public function getAllAnimalNameCho() {
        // select * from animal where id = 1 and idtype = 2
        return $this->sanpham->where('idanimal', '1')->where('idtype', '2')->paginate(3);
    }

    public function getAllAnimalNameChoQA() {
        // select * from animal where id = 1 and idtype = 2
        return $this->sanpham->where('idanimal', '1')->where('idtype', '1')->paginate(3);
    }

    public function getAllAnimalNameChoDC() {
        // select * from animal where id = 1 and idtype = 2
        return $this->sanpham->where('idanimal', '1')->where('idtype', '3')->paginate(3);
    }

    public function getAllAnimalNameMeo() {
        // select * from animal where id = 1 and idtype = 2
        return $this->sanpham->where('idanimal', '2')->where('idtype', '2')->paginate(3);
    }

    public function getAllAnimalNameMeoQA() {
        // select * from animal where id = 1 and idtype = 2
        return $this->sanpham->where('idanimal', '2')->where('idtype', '1')->paginate(3);
    }

    public function getAllAnimalNameMeoDC() {
        // select * from animal where id = 1 and idtype = 2
        return $this->sanpham->where('idanimal', '2')->where('idtype', '3')->paginate(3);
    }

    public function getAllAnimalNameChim() {
        // select * from animal where id = 1 and idtype = 2
        return $this->sanpham->where('idanimal', '3')->paginate(3);
    }

    public function getAllAnimalNameChuot() {
        // select * from animal where id = 1 and idtype = 2
        return $this->sanpham->where('idanimal', '4')->paginate(3);
    }

    public function getAllAnimalNameCa() {
        // select * from animal where id = 1 and idtype = 2
        return $this->sanpham->where('idanimal', '5')->paginate(3);
    }

    // select * from sanpham where idanimal = '1' like '%$keyword%'
    public function getSearchTAC($keyword) {
        
        return $this->sanpham->where('idanimal', '1')->where('idtype', '2')->where('tensp', 'like', '%'.$keyword.'%')->paginate(3);
    }

    public function getSearchQAC($keyword) {
        
        return $this->sanpham->where('idanimal', '1')->where('idtype', '1')->where('tensp', 'like', '%'.$keyword.'%')->paginate(3);
    }

    public function getSearchDCC($keyword) {
        
        return $this->sanpham->where('idanimal', '1')->where('idtype', '3')->where('tensp', 'like', '%'.$keyword.'%')->paginate(3);
    }

    public function getSearchTAM($keyword) {
        
        return $this->sanpham->where('idanimal', '2')->where('idtype', '2')->where('tensp', 'like', '%'.$keyword.'%')->paginate(3);
    }

    public function getSearchQAM($keyword) {
        
        return $this->sanpham->where('idanimal', '2')->where('idtype', '1')->where('tensp', 'like', '%'.$keyword.'%')->paginate(3);
    }

    public function getSearchDCM($keyword) {
        
        return $this->sanpham->where('idanimal', '2')->where('idtype', '3')->where('tensp', 'like', '%'.$keyword.'%')->paginate(3);
    }

    public function getSearchCI($keyword) {
        
        return $this->sanpham->where('idanimal', '3')->where('tensp', 'like', '%'.$keyword.'%')->paginate(3);
    }

    public function getSearchCH($keyword) {
        
        return $this->sanpham->where('idanimal', '4')->where('tensp', 'like', '%'.$keyword.'%')->paginate(3);
    }

    public function getSearchCA($keyword) {
        
        return $this->sanpham->where('idanimal', '5')->where('tensp', 'like', '%'.$keyword.'%')->paginate(3);
    }

    

    // create function get all provide
    public function getAllProvide(): Collection {
        return $this->provide->all();
    }

    public function addTag($request){
        $new = new Tag([
            'tagname' => $request->nametag,
        ]);
        return $new->save();

    }

    // create function add provide
    public function addProvide($request){
        $new = new Provide([
            'proname' => $request->nameprovide,
        ]);
        return $new->save();
    }

    
public function addSanPham($request){

   $new = new SanPham([
       'tensp' => $request->namesp,
       'buyprice' => $request->buyprice,
       'oldprice' => $request->oldprice,
       'mota' => $request->motasp,
       'soluongkho' => $request->soluong,
       'idtag' => $request->tag_id,
       'idtype' => $request->type_id,
       'idanimal' => $request->animal_id,
       'idNCC' => $request->provide_id
   ]);
    $new->save();


       // Lấy ID của sản phẩm mới tạo
   $newId = $new->maSP;
   $arr_image = array();
   // check imageSP not empty
   
   if ($file =  $request->imageSP){
    foreach ($file as $image) {
      
            $image_name = md5(rand(1000, 10000));
            $ext = $image->getClientOriginalExtension();
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'upload/DoAnCho/';
            $image_url = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);
            $arr_image[] = $image_url;
            
            // $test = implode('|', $arr_image); 
            // dd($test);
        //    $imageData = base64_decode($image);
           $imageM = new ImageSP([
               'idsp' => $newId,
               'image' => $image_url,
           ]);
           $imageM->save();
       }
   }
    // dd($request->imageSP);

   
}

public function update($id, $request)
    {
        $sanpham = $this->findOne($id);
        $sanpham->tensp = $request->namesp;
        $sanpham->buyprice = $request->buyprice;
        $sanpham->oldprice = $request->oldprice;
        $sanpham->mota = $request->motasp;
        $sanpham->soluongkho = $request->soluong;
        $sanpham->idtag = $request->tag_id;
        // $sanpham->idtype = $request->type_id;
        // $sanpham->idanimal = $request->animal_id;
        $sanpham->idNCC = $request->provide_id;
        $sanpham->update();
        // $iSP = $sanpham->ImageSP;
        // dd($iSP);
        $newId = $sanpham->maSP;
        
        $arr_image = array();
        // check imageSP not empty
   
        if ($file =  $request->imageSP){
            foreach ($file as $image) {
      
            $image_name = md5(rand(1000, 10000));
            $ext = $image->getClientOriginalExtension();
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'upload/DoAnCho/';
            $image_url = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);
            $arr_image[] = $image_url;
            
                foreach ($sanpham->ImageSP as $iSP) {
                
                $iSP->delete();

                
                }
                 $iSP = new ImageSP([
                'idsp' => $newId,
                'image' => $image_url,
                ]);
                 $iSP->save();
            }
        }
        
    }


    public function delete($id)
    {
        $item = $this->findOne($id);
        if ($item){
            $item->delete();
        }
    }

    // get 7 san pham moi nhat
    public function getNewProduct()
    {
        return $this->sanpham->where('idanimal', 1)
                             ->orderBy('updated_at', 'desc')->take(7)->get();
    } 

    public function getNewProductMeo()
    {
        return $this->sanpham->where('idanimal', 2)
                             ->orderBy('updated_at', 'desc')->take(7)->get();
    }

    public function getNewProductChim()
    {
        return $this->sanpham->where('idanimal', 3)
                             ->orderBy('updated_at', 'desc')->take(7)->get();
    }

    public function getNewProductChuot()
    {
        return $this->sanpham->where('idanimal', 4)
                             ->orderBy('updated_at', 'desc')->take(7)->get();
    }

    public function getNewProductCa()
    {
        return $this->sanpham->where('idanimal', 5)
                             ->orderBy('updated_at', 'desc')->take(7)->get();
    }
}


    