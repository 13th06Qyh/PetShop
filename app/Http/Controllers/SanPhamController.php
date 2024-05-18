<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import service SanPham
use App\Http\Services\SanPhamServices;
use Illuminate\Http\RedirectResponse;


class SanPhamController extends Controller
{
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
        return view('admin.pages.adminQLsanpham', compact('sanphams', 'tags', 'types', 'animals', 'provides'));
    }

    public function create (){
        // get all tag, type, animal, size
        $tags = $this->sanpham->getAllTag();
        $types = $this->sanpham->getAllType();
        $animals = $this->sanpham->getAllAnimal();
        $provides = $this->sanpham->getAllProvide();
        return view('admin.pages.addsanpham', compact('tags', 'types', 'animals', 'provides'));
    }

    public function indexShopCho(Request $request){
        $sanphamW = $this->sanpham->getNewProduct();
        // Pagination for 5 products per page
        $sanphams = $this->sanpham->getAllAnimalNameCho();
        
        return view('user.pages.shopchota', compact('sanphams', 'sanphamW'));
    }

    public function indexShopChoQA(Request $request){
        $sanphamW = $this->sanpham->getNewProduct();
        // Pagination for 5 products per page
        $sanphams = $this->sanpham->getAllAnimalNameChoQA();
        
        return view('user.pages.shopchoqa', compact('sanphams', 'sanphamW'));
    }

    public function indexShopChoDC(Request $request){
        $sanphamW = $this->sanpham->getNewProduct();
        // Pagination for 5 products per page
        $sanphams = $this->sanpham->getAllAnimalNameChoDC();
        
        return view('user.pages.shopchodc', compact('sanphams', 'sanphamW'));
    }

    public function indexShopMeo(Request $request){
        $sanphamW = $this->sanpham->getNewProductMeo();
        // Pagination for 5 products per page
        $sanphams = $this->sanpham->getAllAnimalNameMeo();
        
        return view('user.pages.shopmeota', compact('sanphams', 'sanphamW'));
    }

    public function indexShopMeoQA(Request $request){
        $sanphamW = $this->sanpham->getNewProductMeo();
        // Pagination for 5 products per page
        $sanphams = $this->sanpham->getAllAnimalNameMeoQA();
        
        return view('user.pages.shopmeoqa', compact('sanphams', 'sanphamW'));
    }

    public function indexShopMeoDC(Request $request){
        $sanphamW = $this->sanpham->getNewProductMeo();
        // Pagination for 5 products per page
        $sanphams = $this->sanpham->getAllAnimalNameMeoDC();
        
        return view('user.pages.shopmeodc', compact('sanphams', 'sanphamW'));
    }

    public function indexShopChim(Request $request){
        $sanphamW = $this->sanpham->getNewProductChim();
        // Pagination for 5 products per page
        $sanphams = $this->sanpham->getAllAnimalNameChim();
        
        return view('user.pages.shopchim', compact('sanphams', 'sanphamW'));
    }

    public function indexShopChuot(Request $request){
        $sanphamW = $this->sanpham->getNewProductChuot();
        // Pagination for 5 products per page
        $sanphams = $this->sanpham->getAllAnimalNameChuot();
        
        return view('user.pages.shopchuot', compact('sanphams', 'sanphamW'));
    }

    public function indexShopCa(Request $request){
        $sanphamW = $this->sanpham->getNewProductCa();
        // Pagination for 5 products per page
        $sanphams = $this->sanpham->getAllAnimalNameCa();
        
        return view('user.pages.shopca', compact('sanphams', 'sanphamW'));
    }

    public function searchTAC(Request $request){
        $sanphamW = $this->sanpham->getNewProduct();
        $sanphams = $this->sanpham->getSearchTAC($request->input('search'));
        return view('user.pages.shopchota', compact('sanphams', 'sanphamW'));
    }

    public function searchDCC(Request $request){
        $sanphamW = $this->sanpham->getNewProduct();
        $sanphams = $this->sanpham->getSearchDCC($request->input('search'));
        return view('user.pages.shopchodc', compact('sanphams', 'sanphamW'));
    }

    public function searchQAC(Request $request){
        $sanphamW = $this->sanpham->getNewProduct();
        $sanphams = $this->sanpham->getSearchQAC($request->input('search'));
        return view('user.pages.shopchoqa', compact('sanphams', 'sanphamW'));
    }

    public function searchDCM(Request $request){
        $sanphamW = $this->sanpham->getNewProductMeo();
        $sanphams = $this->sanpham->getSearchDCM($request->input('search'));
        return view('user.pages.shopmeodc', compact('sanphams', 'sanphamW'));
    }

    public function searchQAM(Request $request){
        $sanphamW = $this->sanpham->getNewProductMeo();
        $sanphams = $this->sanpham->getSearchQAM($request->input('search'));
        return view('user.pages.shopmeoqa', compact('sanphams', 'sanphamW'));
    }

    public function searchTAM(Request $request){
        $sanphamW = $this->sanpham->getNewProductMeo();
        $sanphams = $this->sanpham->getSearchTAM($request->input('search'));
        return view('user.pages.shopmeota', compact('sanphams', 'sanphamW'));
    }

    public function searchCI(Request $request){
        $sanphamW = $this->sanpham->getNewProductChim();
        $sanphams = $this->sanpham->getSearchCI($request->input('search'));
        return view('user.pages.shopchim', compact('sanphams', 'sanphamW'));
    }

    public function searchCH(Request $request){
        $sanphamW = $this->sanpham->getNewProductChuot();
        $sanphams = $this->sanpham->getSearchCH($request->input('search'));
        return view('user.pages.shopchuot', compact('sanphams', 'sanphamW'));
    }

    public function searchCA(Request $request){
        $sanphamW = $this->sanpham->getNewProductCa();
        $sanphams = $this->sanpham->getSearchCA($request->input('search'));
        return view('user.pages.shopca', compact('sanphams', 'sanphamW'));
    }

    public function indexOne($id){
        $sanphamIF = $this->sanpham->findOne($id);
        return view('user.pages.infosp', compact('sanphamIF'));
    }

     /**
     * 
     * @return RedirectResponse
     */
    public function storeTag(Request $request){
        $this->sanpham->addTag($request);
        return redirect()->route('admin.add.sanpham');
    }

    public function storeProvide(Request $request){
        $this->sanpham->addProvide($request);
        return redirect()->route('admin.add.sanpham');
    }

    public function storeSanPham(Request $request){
        $this->sanpham->addSanPham($request);
        return redirect()->route('admin.sanpham');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->sanpham->update($id, $request);
        return redirect()->route('admin.sanpham');
    }

    public function destroy($id): RedirectResponse
    {
        $this->sanpham->delete($id);
        return redirect()->route('admin.sanpham');
    }
    

}