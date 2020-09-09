<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected PostRepositoryInterface $postRepository;

    /**
     * Create a new controller instance.
     *
     * @param PostRepositoryInterface $postRepository
     * @return void
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('home', [
            'posts' => $this->postRepository->getPostsByPagNum((int) $request->get('page', 1)),
            'max_posts' => $this->postRepository->getMaxPage(),
        ]);
    }
}
