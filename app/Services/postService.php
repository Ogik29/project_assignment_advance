<?php

namespace App\Services;

use App\Repositories\postRepository;
use MongoDB\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Validator;

class postService
{
    protected $postRepository;

    public function __construct(postRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getById($id)
    {
        $post = $this->postRepository->getById($id);
        return $post;
    }

    public function getAll()
    {
        $post = $this->postRepository->getAll();
        return $post;
    }

    public function addPost($data)
    {
        // $data['user_id'] = auth()->user()->_id;

        return $this->postRepository->addPost($data);
    }

    public function updatePost($data, $id)
    {
        $post = $this->getById($id);

        if (auth()->user()->_id != $post->user_id) {
            return "You Can't";
        }

        if (isset($data['title'])) {
            $editedData['title'] = $data['title'];
        }

        if (isset($data['description'])) {
            $editedData['description'] = $data['description'];
        }

        if ($this->postRepository->updatePost($editedData, $id) < 1) {
            return 'Failed To Update';
        } else {
            $newPost = $this->getById($id);
            return $newPost;
        }
    }

    public function deletePost($id)
    {
        $post = $this->getById($id);

        if (auth()->user()->_id != $post->user_id) {
            return "You Can't";
        }

        if ($this->postRepository->deletePost($id) < 1) {
            return "Failed To Delete";
        } else {
            return 'Successfully To Delete';
        }
    }
}
