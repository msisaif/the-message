<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\Post;
use App\Models\User;
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
        $model_instance = "";

        if (request()->hasFile('image')) {
            $image_path = request()->file('image')->store('image', 'public');
        }
        
        if(request()->option == 'post') {
            $model_instance = Post::find(request()->id);
        }

        if(request()->option == 'video') {
            $model_instance = Video::find(request()->id);
        }
    
        if(request()->option == 'user') {
            $model_instance = User::find(request()->id);
        }
    
        if(request()->option == 'mentor') {
            $model_instance = Mentor::find(request()->id);
        }

        if($model_instance && $image_path) {
            $this->imageUpdateOrCreate($model_instance, $image_path);
        }

        return $image_path;
    }

    protected function imageUpdateOrCreate($model_instance, $image_path)
    {
        $model_instance = $model_instance->image()->updateOrCreate(
            [],
            [
                'url'       => "/" . "storage" . "/" . $image_path,
                'user_id'   => Auth::id(),
            ]
        );

        if($model_instance->image && $model_instance->image->url) {
            Storage::delete(str_replace("storage", "public", $model_instance->image->url));
        }
    }
}
