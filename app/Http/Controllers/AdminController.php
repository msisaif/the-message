<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\DateFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AdminController extends Controller
{
    use DateFilter;

    public function index()
    {
        $admins = $this->setQuery(User::query())
            ->search()->filter()
            ->dateFilter()
            ->getQuery()
            ->onlyAdmin()
            ->latest();

        return Inertia::render('Admin/Index', [
            'admins' => UserResource::collection($admins->paginate(request()->perpage ?? 100)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Create', [
            'admin' => new User(),
        ]);
    }

    public function store(Request $request)
    {
        $admin = User::create($this->validateData($request) + [
            'password'  => Hash::make(123456),
            'type'      => 1,
        ]);

        return redirect()
            ->route('admins.show', $admin->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(User $admin)
    {
        UserResource::withoutWrapping();

        return Inertia::render('Admin/Show', [
            'admin' => new UserResource($admin),
        ]);
    }

    public function edit(User $admin)
    {
        return Inertia::render('Admin/Edit', [
            'admin' => $admin,
        ]);
    }

    public function update(Request $request, User $admin)
    {
        $admin->update($this->validateData($request, $admin->id) + [
            'type' => 1,
        ]);

        return redirect()
            ->route('admins.show', $admin->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(User $admin)
    {
        $admin->delete();

        return redirect()
            ->route('admins.index')
            ->with('status', 'The record has been delete successfully.');
    }

    protected function search()
    {
        $this->getQuery()
            ->when(request()->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('id', $search)
                        ->orWhere('name', 'regexp', $search)
                        ->orWhere('email', 'regexp', $search)
                        ->orWhere('phone', 'regexp', $search);
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
            'name' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique(User::class, 'email')->ignore($id),
            ],
            'phone' => [
                Rule::unique(User::class, 'phone')
                    ->whereNotNull('phone')
                    ->ignore($id),
            ],
        ]);
    }

}
