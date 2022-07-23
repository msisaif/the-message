<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlaylistResource;
use App\Http\Resources\VideoResource;
use App\Models\Playlist;
use App\Models\Playlistable;
use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = $this->setQuery(Playlist::query())
            ->search()->filter()
            ->getQuery();

        return Inertia::render('Playlist/Index', [
            'playlists' => PlaylistResource::collection($playlists->paginate(request()->perpage)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Playlist/Create', [
            'playlist'  => new Playlist(),
            'types'     => Video::getTypeList(),
        ]);
    }

    public function store(Request $request)
    {
        $playlist = Playlist::create($this->validateData($request) + [
            'user_id' => auth()->user()->id,
        ]);

        return redirect()
            ->route('playlists.show', $playlist->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Playlist $playlist)
    {
        PlaylistResource::withoutWrapping();

        return Inertia::render('Playlist/Show', [
            'playlist' => new PlaylistResource($playlist),
        ]);
    }

    public function edit(Playlist $playlist)
    {
        $videos = [];
        
        if(request()->step == 'videos') {
            $playlist->load('videos');
        
            VideoResource::withoutWrapping();
            
            $videos = Video::query()
                ->with('image')
                ->type($playlist->type)
                ->get();

            $videos = VideoResource::collection($videos);
        }
        
        return Inertia::render('Playlist/Edit', [
            'playlist'  => $playlist,
            'types'     => Video::getTypeList(),
            'step'      => request()->step ?? "",
            'videos'    => $videos,
        ]);
    }

    public function update(Request $request, Playlist $playlist)
    {
        if($request->step == "videos") {
            $this->storeVideoOfPlaylist($playlist, $request->video_ids);
        }

        if(!$request->step) {
            $playlist->update($this->validateData($request, $playlist->id));
        }

        return redirect()
            ->route('playlists.show', $playlist->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(Playlist $playlist)
    {
        $playlist->delete();

        return redirect()
            ->route('playlists.index')
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
            'title' => 'required|string|max:255',
            'type'  => 'required|integer',
        ]);
    }

    private function storeVideoOfPlaylist($playlist, $video_ids)
    {
        Playlistable::query()
            ->where('playlist_id', $playlist->id)
            ->where('playlistable_type', Video::class)
            ->update([
                'deleted_at' => now(),
            ]);

        if(is_array($video_ids)) {
            foreach ($video_ids as $video_id) {
                Playlistable::onlyTrashed()->updateOrCreate(
                    [
                        'playlist_id' => $playlist->id,
                    ],
                    [
                        'playlistable_id'   => $video_id,
                        'playlistable_type' => Video::class,
                        'deleted_at'        => null,
                    ]
                );
            }
        }
    }

}
