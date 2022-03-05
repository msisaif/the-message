<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\DateFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{
    use DateFilter;

    public function index()
    {
        $posts = $this->setQuery(Post::query())
            ->search()->filter()
            ->dateFilter()
            ->getQuery();

        return Inertia::render('Post/Index', [
            'posts'   => PostResource::collection($posts->paginate(request()->perpage)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Post/Create', [
            'post'      => new Post(),
            'postTypes' => Post::getTypes(),
        ]);
    }

    public function store(Request $request)
    {
        $post = Post::create($this->validateData($request) + [
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('posts.show', $post->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Post $post)
    {
        PostResource::withoutWrapping();

        return Inertia::render('Post/Show', [
            'post' => new PostResource($post),
        ]);
    }

    public function edit(Post $post)
    {
        return Inertia::render('Post/Edit', [
            'post'      => $post,
            'postTypes' => Post::getTypes(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($this->validateData($request, $post->id));

        return redirect()
            ->route('posts.show', $post->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('status', 'The record has been delete successfully.');
    }

    protected function search()
    {
        $this->getQuery()
            ->when(request()->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('id', $search)
                        ->orWhere('title', 'regexp', $search)
                        ->orWhere('description', 'regexp', $search)
                        ->orWhere('body', 'regexp', $search)
                        ->orWhereHas('user', function ($query) use ($search) {
                            $query->where('name', 'regexp', $search);
                        });
                });
            });

        return $this;
    }

    protected function filter()
    {
        $this->getQuery();

        return $this;
    }

    protected function getFilterProperty()
    {
        return [
            //
        ];
    }

    private function validateData($request, $id = '')
    {
        return $request->validate([
            'title' => [
                'required',
                'string',
            ],
            'description' => [
                'required',
                'string',
            ],
            'body' => [
                'required',
                'string',
            ],
        ]);
    }

}
