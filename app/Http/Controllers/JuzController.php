<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\JuzResource;
use App\Models\Juz;
use App\Traits\DateFilter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JuzController extends Controller
{
    public function index()
    {
        $juzs = $this->setQuery(Juz::query())
            ->search()->filter()
            ->getQuery();

        return Inertia::render('Juz/Index', [
            'juzs' => JuzResource::collection($juzs->paginate(request()->perpage)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        if(Juz::count() >= 30) {
            return redirect()
                ->route('juzs.index')
                ->with('status', '30 Juz has already been created.');
        }

        return Inertia::render('Juz/Create', [
            'juz' => new Juz(),
        ]);
    }

    public function store(Request $request)
    {
        $juz = Juz::create($this->validateData($request));

        return redirect()
            ->route('juzs.show', $juz->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Juz $juz)
    {
        JuzResource::withoutWrapping();

        return Inertia::render('Juz/Show', [
            'juz' => new JuzResource($juz),
        ]);
    }

    public function edit(Juz $juz)
    {
        return Inertia::render('Juz/Edit', [
            'juz' => $juz,
        ]);
    }

    public function update(Request $request, Juz $juz)
    {
        $juz->update($this->validateData($request, $juz->id));

        return redirect()
            ->route('juzs.show', $juz->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(Juz $juz)
    {
        $juz->delete();

        return redirect()
            ->route('juzs.index')
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
            //
        ]);
    }

}
