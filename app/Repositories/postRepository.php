<?php

namespace App\Repositories;

use App\Models\Post;

class postRepository
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getById($id)
    {
        $post = $this->post->find($id);
        return $post;
    }

    public function getAll()
    {
        $post = $this->post->get();
        return $post;
    }

    public function addPost($data)
    {
        $post = $this->post->create($data);
        return $post;
    }

    public function updatePost($data, $id)
    {
        $post = $this->post->where('_id', $id)->update($data);
        return $post;
    }

    public function deletePost($id)
    {
        $post = $this->post->destroy($id);
        return $post;
    }
}
