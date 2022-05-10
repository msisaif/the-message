<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Video;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $query;

    protected function getQuery()
    {
        return $this->query;
    }

    protected function setQuery($query)
    {
        $this->query = $query;
        
        return $this;
    }
    
    public function phpinfo()
    {
        return phpinfo();
    }

    public function imageUploadGetLink()
    {
        // return $request;

        $image_path = "";

        if (request()->hasFile('image')) {
            $image_path = request()->file('image')->store('image', 'public');
        }

        
        if($image_path && request()->model == 'post') {
            $post = Post::find(request()->id);

            if($post->image && $post->image->url) {
                Storage::delete(str_replace("storage", "public", $post->image->url));
            }

            $post->image()->updateOrCreate(
                [],
                [
                    'url'       => "/" . "storage" . "/" . $image_path,
                    'user_id'   => Auth::id(),
                ]
            );
        }

        
        if($image_path && request()->model == 'video') {
            $video = Video::find(request()->id);

            if($video->image && $video->image->url) {
                Storage::delete(str_replace("storage", "public", $video->image->url));
            }

            $video->image()->updateOrCreate(
                [],
                [
                    'url'       => "/" . "storage" . "/" . $image_path,
                    'user_id'   => Auth::id(),
                ]
            );
        }

        return $image_path;
    }
}
