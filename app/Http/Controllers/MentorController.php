<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MentorResource;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MentorController extends Controller
{
    public function index()
    {
        $mentors = $this->setQuery(Mentor::query())
            ->search()->filter()
            ->getQuery();

        return Inertia::render('Mentor/Index', [
            'mentors' => MentorResource::collection($mentors->paginate(request()->perpage)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Mentor/Create', [
            'mentor' => new Mentor(),
        ]);
    }

    public function store(Request $request)
    {
        $mentor = Mentor::create($this->validateData($request) + [
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('mentors.show', $mentor->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Mentor $mentor)
    {
        MentorResource::withoutWrapping();

        return Inertia::render('Mentor/Show', [
            'mentor' => new MentorResource($mentor),
        ]);
    }

    public function edit(Mentor $mentor)
    {
        return Inertia::render('Mentor/Edit', [
            'mentor' => $mentor,
        ]);
    }

    public function update(Request $request, Mentor $mentor)
    {
        $mentor->update($this->validateData($request, $mentor->id) + [
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('mentors.show', $mentor->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(Mentor $mentor)
    {
        $mentor->delete();

        return redirect()
            ->route('mentors.index')
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
            'name' => [
                'required',
                'string',
            ],
            'phone' => [],
            'address' => [],
            'designation' => [],
            'description' => [],
        ]);
    }

}
