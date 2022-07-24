<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlaylistResource;
use App\Http\Resources\VideoResource;
use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecentVideoController extends Controller
{
    public function index()
    {
        $videos = Video::query()
            ->has('playlists', '<')
            ->latest()
            ->type(1)
            ->simplePaginate(20);

        PlaylistResource::withoutWrapping();

        $playlists = Playlist::query()
            ->has('videos')
            ->type(1)
            ->inRandomOrder()
            ->take(12)
            ->get();

        return Inertia::render('RecentVideo/Index', [
            'data' => [
                'videos'    => VideoResource::collection($videos),
                'playlists' => PlaylistResource::collection($playlists),
            ]
        ]);
    }

    public function show(Playlist $playlist)
    {
        if($playlist->type == 2) {
            return redirect()->route('kids-zone.show', $playlist->id);
        }

        $playlist->load('videos');

        $playlists = Playlist::query()
            ->withCount('videos')
            ->has('videos')
            ->type(1)
            ->where('id', '!=', $playlist->id)
            ->inRandomOrder()
            ->simplePaginate(12);

        VideoResource::withoutWrapping();
        PlaylistResource::withoutWrapping();

        return Inertia::render('RecentVideo/Show', [
            'data' => [
                'videos'    => VideoResource::collection($playlist->videos),
                'playlist'  => new PlaylistResource($playlist),
                'playlists' => PlaylistResource::collection($playlists),
            ]
        ]);
    }
}
