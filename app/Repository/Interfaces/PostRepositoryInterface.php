<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

use Illuminate\Support\Collection;

/**
 * Interface PostRepositoryInterface
 * @package App\Repository\Interfaces
 */
interface PostRepositoryInterface
{
    /**
     * Get posts of user.
     *
     * @param int $id_user id of user
     * @param int $skip offset posts
     * @param int $limit max posts
     * @return Collection result
     */
    public function getPostsOfUser(int $id_user, int $skip = 0, int $limit = 1000): Collection;

    /**
     * Get last posts.
     *
     * @return Collection
     */
    public function getLastPosts(): Collection;

    /**
     * Get posts by number pagination.
     *
     * @param int $numPage
     * @return Collection
     */
    public function getPostsByPagNum(int $numPage): Collection;

    /**
     * Max count page with pagination.
     *
     * @return int
     */
    public function getMaxPage(): int;
}
