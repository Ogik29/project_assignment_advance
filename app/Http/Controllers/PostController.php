<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\postService;
use Exception;

class PostController extends Controller
{
    protected $postService;

    public function __construct(postService $postService)
    {
        $this->postService = $postService;
    }

    public function getAllPost()
    {
        $post = $this->postService->getAll();
        return $post;
    }

    public function createPost(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $validateData['user_id'] = auth()->user()->_id;

        $post = $this->postService->addPost($validateData);
        return $post;
    }

    public function updatePost(Request $request, $id)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $post = $this->postService->updatePost($validateData, $id);
        return $post;
    }

    public function deletePost($id)
    {
        $post = $this->postService->deletePost($id);
        return $post;
    }
}
