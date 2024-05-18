<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CommentServices;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    private CommentServices $cmt;
    public function __construct(CommentServices $cmt)
    {
        $this->cmt = $cmt;
    }

    public function index(){
        $cmts = $this->cmt->getAll();
        return view('user.pages.reviewchitiet', compact('cmts'));
    }
}