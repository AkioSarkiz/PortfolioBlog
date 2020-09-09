<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Response;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController
{
    protected User $user;

    protected PostRepositoryInterface $postRepository;

    /**
     * ProfileController constructor.
     * @param User $user
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(User $user, PostRepositoryInterface $postRepository)
    {
        $this->user = $user;
        $this->postRepository = $postRepository;
    }

    /**
     * @param string $context
     * @return Response
     */
    public function index(string $context = null): Response
    {
        $profile = $this->getProfileByContext($context);

        return response()->view('profile', [
            'profile' => $profile,
            'posts' => $this->postRepository->getPostsOfUser($profile->id),
        ]);
    }

    /**
     * @param string $context
     * @return User
     */
    private function getProfileByContext(?string $context): User
    {
        if (is_numeric($context)) {
            return $this->user->findOrFail($context);
        } elseif (is_null($context) && \Auth::check()) {
            return \Auth::user();
        }

        abort(404);
    }
}
