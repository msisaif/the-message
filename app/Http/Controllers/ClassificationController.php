<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassificationResource;
use App\Http\Resources\SuraResource;
use App\Models\Classification;
use App\Models\Sura;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ClassificationController extends Controller
{
    public function index()
    {
        $classifications = $this->setQuery(Classification::query())
            ->search()->filter()
            ->getQuery();

        return Inertia::render('Classification/Index', [
            'classifications' => ClassificationResource::collection($classifications->paginate(request()->perpage)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        SuraResource::withoutWrapping();

        return Inertia::render('Classification/Create', [
            'data' => [
                'classification'    => new Classification(),
                'suras'             => SuraResource::collection(Sura::query()->orderBy('sura_number')->get())
            ]
        ]);
    }

    public function store(Request $request)
    {
        $classification = Classification::create($this->validateData($request));

        return redirect()
            ->route('classifications.show', $classification->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Classification $classification)
    {
        ClassificationResource::withoutWrapping();

        return Inertia::render('Classification/Show', [
            'classification' => new ClassificationResource($classification),
        ]);
    }

    public function edit(Classification $classification)
    {
        SuraResource::withoutWrapping();

        return Inertia::render('Classification/Edit', [
            'data' => [
                'classification'    => $classification,
                'suras'             => SuraResource::collection(Sura::query()->orderBy('sura_number')->get())
            ]
        ]);
    }

    public function update(Request $request, Classification $classification)
    {
        $classification->update($this->validateData($request, $classification->id));

        return redirect()
            ->route('classifications.show', $classification->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(Classification $classification)
    {
        $classification->delete();

        return redirect()
            ->route('classifications.index')
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
            'sura_number'   => [
                'required',
                'numeric',
            ],
            'ayah'      => [
                'required',
                'string',
                Rule::unique(Classification::class)
                    ->where('sura_number', $request->sura_number)
                    ->ignore($id)
            ],
            'topic'     => [
                'required',
                'string',
            ],
        ]);
    }

}
