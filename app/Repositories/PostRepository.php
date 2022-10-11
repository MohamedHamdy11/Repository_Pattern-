<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        return Post::all();
    }

    public function getPostById($PostId)
    {
        return Post::findOrFail($PostId);
    }

    public function deletePost($PostId)
    {
        return Post::destroy($PostId);
    }

    public function createPost(array $PostDetails)
    {
        return Post::create($PostDetails);
    }

    public function updatePost($PostId, array $newDetails)
    {
        return Post::whereId($PostId)->update($newDetails);
    } // end of update


} // end of PostRepository
