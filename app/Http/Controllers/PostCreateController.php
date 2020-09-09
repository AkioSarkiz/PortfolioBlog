<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use function response;

class PostCreateController extends Controller
{
    protected Post $post;
    protected Post $currentPost;

    public function __construct(Post $post)
    {
        $this->middleware('auth');
        $this->post = $post;
    }

    public function index(): Response
    {
        return response()->view('new_blog');
    }

    public function handleCreate(CreatePostRequest $request): RedirectResponse
    {
        if ($this->createPost($request)) {
            return response()->redirectToRoute('post', [
                'context' => $this->currentPost->id
            ]);
        }

        return redirect()->route('new_blog')
            ->withErrors(['create' => 'Your data is invalid']);
    }

    private function createPost(CreatePostRequest $request): bool
    {
        $data = [
            'title' => $request->get('title', 'unnamed'),
            'id_author' => Auth::id(),
            'content' => $request->get('content'),
            'description' => mb_substr($request->get('content'), 0, 200),
            'media' => [],
        ];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $direction = pathinfo($file->store('uploads', ['disk' => 'public']), PATHINFO_BASENAME);
                if (count($data['media']) === 0) {
                    $data['media']['cover'] = $direction;
                } else {
                    array_push($data['media'], $direction);
                }
            }
        }

        $this->currentPost = Post::create($data);
        return (bool) $this->currentPost;
    }
}
