<?php

namespace App\Http\Controllers;

use App\Models\Post;
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

            Storage::delete(str_replace("storage", "public", $post->image->url));

            $post->image()->updateOrCreate(
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
