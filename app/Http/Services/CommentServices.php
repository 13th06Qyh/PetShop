<?php

namespace App\Http\Services;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentServices {
    private Blog $blog;
    private Comment $comment;

    public function __construct(Blog $blog, Comment $comment)
    {
        $this->blog = $blog;
        $this->comment = $comment;
    }

    public function getAll(): Collection {
        return $this->comment->all();
    }
    
    public function findOne($id)
    {
        // \dd($id);
        return $this->blog->find($id);
    }


         
}


    