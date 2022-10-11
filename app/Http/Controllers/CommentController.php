<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Interfaces\CommentRepositoryInterface;
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

        $CommentDetails->user_id = auth()->user()->id;
        $this->CommentRepository->createComment($CommentDetails);

        return redirect()->back()
                        ->with('success','Comment created successfully.');
    } // end of storeComment


} // end of CommentController
