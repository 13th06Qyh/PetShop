<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\BlogServices;
use Illuminate\Http\RedirectResponse;

class BlogController extends Controller
{
    private BlogServices $blog;
    public function __construct(BlogServices $blog)
    {
        $this->blog = $blog;
    }

    public function index(){
        $blogs = $this->blog->getAll();
        $animals = $this->blog->getAllAnimal();
        return view('admin.pages.adminQLblog', compact('blogs', 'animals'));
    }

    public function create (){
        $animals = $this->blog->getAllAnimal();
        return view('admin.pages.addblog', compact('animals'));
    }

    public function storeBlog(Request $request){
        $this->blog->addBlog($request);
        return redirect()->route('admin.blog');
    }

    public function edit($id){
        $blogs = $this->blog->findOne($id);
        $animals = $this->blog->getAllAnimal();
        return view('admin.pages.updateblog', compact('blogs', 'animals'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->blog->update($id, $request);
        return redirect()->route('admin.blog');
    }

    public function destroy($id): RedirectResponse
    {
        $this->blog->delete($id);
        return redirect()->route('admin.blog');
    }

    public function indexBlogCho(Request $request){
        $blogW = $this->blog->getNewBlog();
        // Pagination for 5 products per page
        $blogs = $this->blog->getAllAnimalNameCho();
        $all = $this->blog->getAll();
        return view('user.pages.blogcho', compact('blogs', 'blogW', 'all'));
    }

    public function searchBC(Request $request){
        $blogW = $this->blog->getNewBlog();
        $blogs = $this->blog->getSearchBC($request->input('search'));
        $all = $this->blog->getAll();
        return view('user.pages.blogcho', compact('blogs', 'blogW', 'all'));
    }

    public function indexBlogMeo(Request $request){
        $blogW = $this->blog->getNewBlogMeo();
        // Pagination for 5 products per page
        $blogs = $this->blog->getAllAnimalNameMeo();
        $all = $this->blog->getAll();
        return view('user.pages.blogmeo', compact('blogs', 'blogW', 'all'));
    }

    public function searchBM(Request $request){
        $blogW = $this->blog->getNewBlogMeo();
        $blogs = $this->blog->getSearchBM($request->input('search'));
        $all = $this->blog->getAll();
        return view('user.pages.blogmeo', compact('blogs', 'blogW', 'all'));
    }

    public function indexBlogChim(Request $request){
        $blogW = $this->blog->getNewBlogChim();
        // Pagination for 5 products per page
        $blogs = $this->blog->getAllAnimalNameChim();
        $all = $this->blog->getAll();
        return view('user.pages.blogchim', compact('blogs', 'blogW', 'all'));
    }

    public function searchBCI(Request $request){
        $blogW = $this->blog->getNewBlogChim();
        $blogs = $this->blog->getSearchBCI($request->input('search'));
        $all = $this->blog->getAll();
        return view('user.pages.blogchim', compact('blogs', 'blogW', 'all'));
    }

    public function indexBlogChuot(Request $request){
        $blogW = $this->blog->getNewBlogChuot();
        // Pagination for 5 products per page
        $blogs = $this->blog->getAllAnimalNameChuot();
        $all = $this->blog->getAll();
        return view('user.pages.blogchuot', compact('blogs', 'blogW', 'all'));
    }

    public function searchBCU(Request $request){
        $blogW = $this->blog->getNewBlogChuot();
        $blogs = $this->blog->getSearchBCU($request->input('search'));
        $all = $this->blog->getAll();
        return view('user.pages.blogchuot', compact('blogs', 'blogW', 'all'));
    }

    public function indexBlogCa(Request $request){
        $blogW = $this->blog->getNewBlogCa();
        // Pagination for 5 products per page
        $blogs = $this->blog->getAllAnimalNameCa();
        $all = $this->blog->getAll();
        return view('user.pages.blogca', compact('blogs', 'blogW', 'all'));
    }

    public function searchBCA(Request $request){
        $blogW = $this->blog->getNewBlogCa();
        $blogs = $this->blog->getSearchBCA($request->input('search'));
        $all = $this->blog->getAll();
        return view('user.pages.blogca', compact('blogs', 'blogW', 'all'));
    }

    public function indexReview($id){
        // \dd($id);
        $blogW = $this->blog->getNews();
        // \dd($blogW);
        $blogIF = $this->blog->findOne($id);
        // \dd($blogIF);
        $comments = $this->blog->getComment($id);
        // \dd($comments);
        $commentD = $this->blog->getAllComment($id);
        // dd($commentD);
        $all = $this->blog->getAll();
        return view('user.pages.reviewchitiet', compact('blogIF', 'blogW', 'comments', 'commentD', 'all'));
    }

    public function addComment(Request $request, $id){
        $this->blog->sendComment($id, $request);
        return redirect()->back();
    }

    public function updateComment(Request $request, $id){
        $a = $this->blog->editComment($id, $request);
        // \dd($a);
        // $blog = $this->blog->findOne($id);
        return redirect()->route('reviewchitiet.view', $a);
    }

    public function destroyComment($id){
        $this->blog->deleteComment($id);
        return redirect()->back();
    }

    public function showDetailAdmin($id){
        $blogs = $this->blog->findOne($id);
        $commentD = $this->blog->getAllCommenttoBlog($id);
        return view('admin.pages.adminDetailComment', compact('commentD', 'blogs'));
    }

}