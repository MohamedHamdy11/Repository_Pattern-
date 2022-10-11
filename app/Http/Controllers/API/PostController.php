<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\PostRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostRepositoryInterface $PostRepository;

    public function __construct(PostRepositoryInterface $PostRepository)
    {
        $this->PostRepository = $PostRepository;
    }

    public function index()
    {
        return response()->json([
            'data' => $this->PostRepository->getAllPosts()
        ]);
    }

    public function store(PostRequest $request)
    {
        $PostDetails = $request->validated();

        return response()->json([
            'status' => 'success',
            'Message' => 'Post created successfully.',
            'data' => $this->PostRepository->createPost($PostDetails)
        ],200);

    }

    public function show(Post $post)
    {
        return  response()->json(['data' => $this->PostRepository->getPostById($post->id)]);

    }


    public function update(PostRequest $request, Post $post)
    {
        $PostDetails = $request->validated();
        return response()->json([
            'status' => 'success',
            'Message' => 'Post updated successfully.',
            'data' => $this->PostRepository->updatePost($post->id, $PostDetails)
        ]);
    }

    public function destroy(Post $post)
    {
        $this->PostRepository->deletePost($post->id);

        return response()->json([
            'status' => 'success',
            'Message' => 'Post deleted successfully.'
        ]);
    }

} // end of PostController
