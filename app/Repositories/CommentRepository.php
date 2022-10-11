<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function getAllCommentsByPostId($PostId)
    {
        return Comment::where('post_id', $PostId)->get();
    }

    public function createComment(array $CommentDetails)
    {
        return Comment::create($CommentDetails);
    }



} // end of CommentRepository
