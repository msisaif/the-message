<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlaylistResource;
use App\Http\Resources\VideoResource;
use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KidsZoneController extends Controller
{
    public function index()
    {
        $videos = Video::query()
            ->has('playlists', '<')
            ->latest()
            ->type(2)
            ->simplePaginate(20);

        $playlists = Playlist::query()
            ->has('videos')
            ->latest()
            ->type(1)
            ->simplePaginate(20);

        return Inertia::render('KidsZone/Index', [
            'videos'    => VideoResource::collection($videos),
            'playlists' => PlaylistResource::collection($playlists),
        ]);
    }

    public function show(Playlist $playlist)
    {
        $playlist->load('videos');

        $playlists = Playlist::query()
            ->has('videos')
            ->type(2)
            ->inRandomOrder()
            ->simplePaginate(12);

        VideoResource::withoutWrapping();
        PlaylistResource::withoutWrapping();

        return Inertia::render('KidsZone/Show', [
            'data' => [
                'videos'    => VideoResource::collection($playlist->videos),
                'playlist'  => new PlaylistResource($playlist),
                'playlists' => PlaylistResource::collection($playlists),
            ]
        ]);
    }
}
