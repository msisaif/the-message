<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectwiseResource;
use App\Models\Category;
use App\Models\Subjectwise;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubjectwiseController extends Controller
{
    public function index()
    {
        $subjectwises = $this->setQuery(Subjectwise::query())
            ->search()->filter()
            ->getQuery()
            ->orderBy('category_id')
            ->orderBy('type');

        return Inertia::render('Subjectwise/Index', [
            'subjectwises' => SubjectwiseResource::collection($subjectwises->paginate(request()->perpage)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Subjectwise/Create', [
            'subjectwise' => new Subjectwise(),
            'categories' => Category::get(),
        ]);
    }

    public function store(Request $request)
    {
        $subjectwise = Subjectwise::create($this->validateData($request));

        return back()
            ->with('status', "<div dir='rtl'>{$subjectwise->arabic}</div><div>{$subjectwise->bengali}</div>");

        return redirect()
            ->route('subjectwises.show', $subjectwise->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Subjectwise $subjectwise)
    {
        SubjectwiseResource::withoutWrapping();

        return Inertia::render('Subjectwise/Show', [
            'subjectwise' => new SubjectwiseResource($subjectwise),
        ]);
    }

    public function edit(Subjectwise $subjectwise)
    {
        return Inertia::render('Subjectwise/Edit', [
            'subjectwise' => $subjectwise,
            'categories' => Category::get(),
        ]);
    }

    public function update(Request $request, Subjectwise $subjectwise)
    {
        $subjectwise->update($this->validateData($request, $subjectwise->id));

        return redirect()
            ->route('subjectwises.show', $subjectwise->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(Subjectwise $subjectwise)
    {
        $subjectwise->delete();

        return redirect()
            ->route('subjectwises.index')
            ->with('status', 'The record has been delete successfully.');
    }

    protected function search()
    {
        $this->getQuery()
            ->when(request()->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('id', 'regexp', $search)
                        ->orWhereHas('category', function($query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");
                        });
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
            'category_id' => [
                'required',
                'numeric',
            ],
            'type' => [
                'required',
                'numeric',
            ],
            'title' => [],
            'arabic' => [],
            'bengali' => [],
        ]);
    }

}
