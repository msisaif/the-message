<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use App\Traits\DateFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class VideoController extends Controller
{
    public function index()
    {
        $videos = $this->setQuery(Video::query())
            ->search()->filter()
            ->getQuery();

        return Inertia::render('Video/Index', [
            'videos' => VideoResource::collection($videos->paginate(request()->perpage)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Video/Create', [
            'video' => new Video(),
        ]);
    }

    public function store(Request $request)
    {
        $video = Video::create($this->validateData($request) + [
            'user_id' => Auth::id(),
            'type' => 1,
        ]);

        return redirect()
            ->route('videos.show', $video->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Video $video)
    {
        VideoResource::withoutWrapping();

        $video->load('image');

        return Inertia::render('Video/Show', [
            'video' => new VideoResource($video),
        ]);
    }

    public function edit(Video $video)
    {
        return Inertia::render('Video/Edit', [
            'video' => $video,
        ]);
    }

    public function update(Request $request, Video $video)
    {
        $video->update($this->validateData($request, $video->id));

        return redirect()
            ->route('videos.show', $video->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()
            ->route('videos.index')
            ->with('status', 'The record has been delete successfully.');
    }

    protected function search()
    {
        $this->getQuery()
            ->when(request()->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('id', 'regexp', $search);
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
            'title' => 'required',
            'url' => [
                'required',
                Rule::unique(Video::class, 'url')->ignore($id),
            ],
        ]);
    }

}
