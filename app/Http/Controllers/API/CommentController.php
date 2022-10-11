<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CommentRequest;
use App\Interfaces\CommentRepositoryInterface;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private CommentRepositoryInterface $CommentRepository;

    public function __construct(CommentRepositoryInterface $CommentRepository)
    {
        $this->CommentRepository = $CommentRepository;
    } // end of construct


    public function storeComment(CommentRequest $request)
    {
        $CommentDetails = $request->validated();

        return response()->json([
            'status' => 'success',
            'Message' => 'Comment created successfully.',
            'data' => $this->CommentRepository->createComment($CommentDetails)
            ],200);
                
    } // end of storeComment

    
    public function commmentsPost(Post $post)
    {
        return  response()->json(['data' => $this->CommentRepository->getAllCommentsByPostId($post->id)]);
    } // end of commentsPost


} // end of CommentController
