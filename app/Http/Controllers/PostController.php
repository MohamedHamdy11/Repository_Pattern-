<?php
declare(strict_types=1);

namespace App\Http\Controllers;

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
        return view()->with([
            'data' => $this->PostRepository->getAllPosts()
        ]);
    }

    public function create()
    {
        return view('Post.create');

    }

    public function store(PostRequest $request)
    {

        $PostDetails = $request->validated();
        if($request->image) {
            $PostDetails['image'] = $request->image->store('posts','public');
        }
        $PostDetails->user_id = auth()->user()->id;
        $this->PostRepository->createPost($PostDetails);

        return redirect()->route('post.index')
                        ->with('success','Post created successfully.');

    }

    public function show(Post $post)
    {
        return view('Post.show')
                ->with(['data' => $this->PostRepository->getPostById($post->id)]);
        
    }

    public function edit(Post $post)
    {
        return view('Post.edit')
                ->with(['data' => $this->PostRepository->getPostById($post->id)]);
        
    }

    public function update(PostRequest $request, Post $post)
    {
     
        $PostDetails = $request->validated();
        if($request->image) {
            $PostDetails['image'] = $request->image->store('posts','public');
        }
        $PostDetails->user_id = auth()->user()->id;
        return redirect()->route('post.index')
        ->with([
            'data' => $this->PostRepository->updatePost($post->id, $PostDetails),
            'success' => 'Post deleted successfully.'
        ]);
    }

    public function destroy(Post $post)
    {    
        $this->PostRepository->deletePost($post->id);

        return redirect()->route('post.index')
        ->with('success','Post deleted successfully.');
    }

}
