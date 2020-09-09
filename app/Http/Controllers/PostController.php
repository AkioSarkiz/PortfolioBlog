<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Response;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController
{
    protected Post $post;

    /**
     * PostController constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @param string $context
     * @return Response
     */
    public function index(string $context): Response
    {
        $post = $this->getPostByContext($context);

        return response()->view('post', [
            'post' => $post,
            'author' => User::findOrFail($post->id_author),
        ]);
    }

    /**
     * @param string $context
     * @return Post|null
     */
    public function getPostByContext(string $context): Post
    {
        if (is_numeric($context)) {
            return $this->post->findOrFail((int)$context);
        }

        abort(404);
    }
}
