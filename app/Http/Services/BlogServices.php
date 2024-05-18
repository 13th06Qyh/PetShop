<?php

namespace App\Http\Services;

use App\Models\Blog;
use App\Models\Animal;
use App\Models\Comment;
use App\Models\ImageBlog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogServices {
    private Blog $blog;
    private Animal $animal;
    private Comment $comment;
    private ImageBlog $imageBlog;

    public function __construct(Blog $blog, Animal $animal, Comment $comment, ImageBlog $imageBlog)
    {
        $this->blog = $blog;
        $this->animal = $animal;
        $this->comment = $comment;
        $this->imageBlog = $imageBlog;
    }

    public function getAll(): Collection {
        return $this->blog->all();
    }

    public function getAllAnimal(): Collection {
        return $this->animal->all();
    }
    
    public function findOne($id)
    {
        // \dd($id);
        return $this->blog->find($id);
    }

    public function getNews(){
        return $this->blog->orderBy('updated_at', 'desc')->take(4)->get();
    }

    public function getNewBlog()
    {
        return $this->blog->where('idanimal', 1)
                             ->orderBy('updated_at', 'desc')->take(4)->get();
    }
    
    public function getAllAnimalNameCho() {
        // select * from animal where id = 1 and idtype = 2
        return $this->blog->where('idanimal', '1')->paginate(3);
    }

    public function getSearchBC($keyword) {
        
        return $this->blog->where('idanimal', '1')->where('title', 'like', '%'.$keyword.'%')->paginate(3);
    }

    public function getNewBlogMeo()
    {
        return $this->blog->where('idanimal', 2)
                             ->orderBy('updated_at', 'desc')->take(4)->get();
    }
    
    public function getAllAnimalNameMeo() {
        // select * from animal where id = 1 and idtype = 2
        return $this->blog->where('idanimal', '2')->paginate(3);
    }

    public function getSearchBM($keyword) {
        
        return $this->blog->where('idanimal', '2')->where('title', 'like', '%'.$keyword.'%')->paginate(3);
    }

    public function getNewBlogChim()
    {
        return $this->blog->where('idanimal', 3)
                             ->orderBy('updated_at', 'desc')->take(4)->get();
    }
    
    public function getAllAnimalNameChim() {
        // select * from animal where id = 1 and idtype = 2
        return $this->blog->where('idanimal', '3')->paginate(3);
    }

    public function getSearchBCI($keyword) {
        
        return $this->blog->where('idanimal', '3')->where('title', 'like', '%'.$keyword.'%')->paginate(3);
    }

    public function getNewBlogChuot()
    {
        return $this->blog->where('idanimal', 4)
                             ->orderBy('updated_at', 'desc')->take(4)->get();
    }
    
    public function getAllAnimalNameChuot() {
        // select * from animal where id = 1 and idtype = 2
        return $this->blog->where('idanimal', '4')->paginate(3);
    }

    public function getSearchBCU($keyword) {
        
        return $this->blog->where('idanimal', '4')->where('title', 'like', '%'.$keyword.'%')->paginate(3);
    }

    public function getNewBlogCa()
    {
        return $this->blog->where('idanimal', 5)
                             ->orderBy('updated_at', 'desc')->take(4)->get();
    }
    
    public function getAllAnimalNameCa() {
        // select * from animal where id = 1 and idtype = 2
        return $this->blog->where('idanimal', '5')->paginate(3);
    }

    public function getSearchBCA($keyword) {
        
        return $this->blog->where('idanimal', '5')->where('title', 'like', '%'.$keyword.'%')->paginate(3);
    }

    public function addBlog($request){

        $new = new Blog([
            'title' => $request->titleblog,
            'noidung' => $request->content,
            'idanimal' => $request->animal_id,
        ]);
         $new->save();
     
     
            // Lấy ID của sản phẩm mới tạo
        $newId = $new->maBlog;
        $arr_image = array();
        // check imageBlog not empty
        // dd($request->imageBlog);
        if ($file =  $request->imageBlog){
         foreach ($file as $image) {
           
                 $image_name = md5(rand(1000, 10000));
                 $ext = $image->getClientOriginalExtension();
                 $image_full_name = $image_name . '.' . $ext;
                 $upload_path = 'upload/Blog/';
                 $image_url = $upload_path . $image_full_name;
                 $image->move($upload_path, $image_full_name);
                 $arr_image[] = $image_url;
                 
                 // $test = implode('|', $arr_image); 
                 // dd($test);
             //    $imageData = base64_decode($image);
                $imageM = new ImageBlog([
                    'idblog' => $newId,
                    'image' => $image_url,
                ]);
                $imageM->save();
            }
        }
         // dd($request->imageBlog);
     
        
     }
     
     public function update($id, $request)
         {
             $blog = $this->findOne($id);
            //  dd($blog);
             $blog->title = $request->titleblog;
             $blog->noidung = $request->content;
            //  $blog->idanimal = $request->animal_id;
             $blog->update();
             // $iSP = $sanpham->ImageSP;
             // dd($iSP);
             $newId = $blog->maBlog;
            // \dd($newId);
             $arr_image = array();
             // check imageSP not empty
        
             if ($file =  $request->imageBlog){
                 foreach ($file as $image) {
           
                 $image_name = md5(rand(1000, 10000));
                 $ext = $image->getClientOriginalExtension();
                 $image_full_name = $image_name . '.' . $ext;
                 $upload_path = 'upload/Blog/';
                 $image_url = $upload_path . $image_full_name;
                 $image->move($upload_path, $image_full_name);
                 $arr_image[] = $image_url;
                 
                     foreach ($blog->ImageBlog as $iB) {
                     
                     $iB->delete();
     
                     
                     }
                      $iB = new ImageBlog([
                     'idblog' => $newId,
                     'image' => $image_url,
                     ]);
                      $iB->save();
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

         public function sendComment($id, $request) {
            $comment = $this->findOne($id);
            // dd($comment->maBlog);
            $new = new Comment([
                'iduser' => auth()->user()->id,
                'idblog' => $comment->maBlog,
                'noidungbl' => $request->comment,
            ]);
            return $new->save();
         }

         public function getComment($id) {
            return $this->blog->find($id)->comment;
         }

         public function editComment($id, $request) {
            // dd($id);
            $cmt = $this->comment->find($id);
            //  dd($cmt);
            // dd($cmt->idblog);
            $cmt->noidungbl = $request->commentt;
            $cmt->update();
            return $cmt->idblog;
         }

         public function deleteComment($id){
            $item = $this->comment->find($id);
            // dd($item);
            if ($item){
                $item->delete();
            }
         }

         public function getAllCommenttoBlog($id) {
            // \dd($id);
            return $this->comment->where('idblog', $id)->get();
        }

        public function getAllComment($id) {
            // \dd($id);
            // return $this->comment->where('idblog', $id)->paginate(5);
            return $this->comment
        ->where('idblog', $id)
        ->orderByRaw('iduser = ? DESC, created_at DESC', [auth()->user()->id])
        ->paginate(5);
        }
        
        

         
}


    