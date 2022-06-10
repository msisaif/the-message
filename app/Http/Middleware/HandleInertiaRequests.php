<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $user = $request->user();

        if($user) {
            $user->avatar = (string) ($user->image->url ?? '');
            $user->firstLatter = (string) (mb_strtoupper(mb_substr($user->name ?? '', 0, 1, 'utf-8'), 'utf-8') ?? '');
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user,
            ],
            'request' => $request,
            'permissions' => auth()->user()
                ? json_encode($request->user()->allPermissions, true)
                : [],
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'status' => fn () => $request->session()->get('status'),
            ],
        ]);
    }
}
