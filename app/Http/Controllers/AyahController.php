<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AyahResource;
use App\Models\Ayah;
use App\Models\Sura;
use App\Traits\DateFilter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AyahController extends Controller
{
    public function index()
    {
        $ayahs = $this->setQuery(Ayah::query())
            ->search()->filter()
            ->getQuery();

        return Inertia::render('Ayah/Index', [
            'ayahs' => AyahResource::collection($ayahs->paginate(request()->perpage)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        // return
        $suras = Sura::with('ayahs')->get();

        return Inertia::render('Ayah/Create', [
            'ayah' => new Ayah(),
            'suras' => $suras,
        ]);
    }

    public function store(Request $request)
    {
        $ayah = Ayah::create($this->validateData($request));

        return redirect()
            ->route('ayahs.show', $ayah->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Ayah $ayah)
    {
        AyahResource::withoutWrapping();

        return Inertia::render('Ayah/Show', [
            'ayah' => new AyahResource($ayah),
        ]);
    }

    public function edit(Ayah $ayah)
    {
        $suras = Sura::with('ayahs')->get();

        return Inertia::render('Ayah/Edit', [
            'ayah' => $ayah,
            'suras' => $suras,
        ]);
    }

    public function update(Request $request, Ayah $ayah)
    {
        $ayah->update($this->validateData($request, $ayah->id));

        return redirect()
            ->route('ayahs.show', $ayah->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(Ayah $ayah)
    {
        $ayah->delete();

        return redirect()
            ->route('ayahs.index')
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
