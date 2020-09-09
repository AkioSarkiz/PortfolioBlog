<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Post;
use App\Repository\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Collection;

class PostRepository implements PostRepositoryInterface
{
    /**
     * Step posts - сколько постов может быть на одной странице
     *
     * @var int
     */
    protected int $stepPosts = 10;

    protected Post $post;

    /**
     * PostRepository constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @inheritDoc
     */
    public function getPostsOfUser(int $id_user, int $skip = 0, int $limit = 1000): Collection
    {
        return $this->post
            ->where('id_author', $id_user)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getLastPosts(): Collection
    {
        return $this->post->orderBy('created_at', 'desc')->get();
    }

    /**
     * @inheritDoc
     */
    public function getPostsByPagNum(int $numPage): Collection
    {
        return $this->post->skip($this->stepPosts * ($numPage - 1))
            ->orderBy('created_at', 'desc')
            ->take($this->stepPosts)
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getMaxPage(): int
    {
        return intval($this->post->all()->count() / $this->stepPosts);
    }
}
