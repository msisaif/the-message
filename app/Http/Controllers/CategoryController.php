<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\DateFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = $this->setQuery(Category::query())
            ->search()->filter()
            ->getQuery();

        return Inertia::render('Category/Index', [
            'categories' => CategoryResource::collection($categories->paginate(request()->perpage)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Category/Create', [
            'category' => new Category(),
        ]);
    }

    public function store(Request $request)
    {
        $category = Category::create($this->validateData($request) + [
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('categories.show', $category->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Category $category)
    {
        CategoryResource::withoutWrapping();

        return Inertia::render('Category/Show', [
            'category' => new CategoryResource($category),
        ]);
    }

    public function edit(Category $category)
    {
        return Inertia::render('Category/Edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $category->update($this->validateData($request, $category->id));

        return redirect()
            ->route('categories.show', $category->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
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
                Rule::unique(Category::class, 'name')->ignore($id),
            ]
        ]);
    }

}
