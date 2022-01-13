<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\JuzResource;
use App\Http\Resources\SuraResource;
use App\Models\Juz;
use App\Models\Sura;
use App\Traits\DateFilter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuraController extends Controller
{
    use DateFilter;

    public function index()
    {
        $suras = $this->setQuery(Sura::query())
            ->search()->filter()
            ->getQuery()
            ->orderBy('sura_number');

        return Inertia::render('Sura/Index', [
            'suras' => SuraResource::collection($suras->paginate(request()->perpage ?? 100)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        if(Sura::count() >= 114) {
            return redirect()
                ->route('suras.index')
                ->with('status', '114 Sura has already been created.');
        }

        JuzResource::withoutWrapping();

        $juzs = Juz::query()
            ->orderBy('juz_number')
            ->get();

        return Inertia::render('Sura/Create', [
            'data' => [
                'sura' => new Sura(),
                'juzs' => JuzResource::collection($juzs),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $sura = Sura::create($this->validateData($request));

        return redirect()
            ->route('suras.show', $sura->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Sura $sura)
    {
        SuraResource::withoutWrapping();

        return Inertia::render('Sura/Show', [
            'sura' => new SuraResource($sura),
        ]);
    }

    public function edit(Sura $sura)
    {
        JuzResource::withoutWrapping();

        $juzs = Juz::query()
            ->orderBy('juz_number')
            ->get();

        return Inertia::render('Sura/Edit', [
            'data' => [
                'sura' => $sura,
                'juzs' => JuzResource::collection($juzs),
            ],
        ]);
    }

    public function update(Request $request, Sura $sura)
    {
        $sura->update($this->validateData($request, $sura->id));

        return redirect()
            ->route('suras.show', $sura->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(Sura $sura)
    {
        $sura->delete();

        return redirect()
            ->route('suras.index')
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
            'sura_number' => [
                'required',
                'numeric',
            ],
            'juz_number' => [
                'required',
                'numeric',
            ],
            'total_ayah' => [
                'required',
                'numeric',
            ],
            'bismillah_pre' => [
                'required',
                'boolean',
            ],
            'revelation_place' => [
                'required',
                'numeric',
            ],
            'revelation_order' => '',
            'arabic' => [
                'required',
                'string',
            ],
            'latin' => [
                'required',
                'string',
            ],
            'bengali' => [
                'required',
                'string',
            ],
            'english' => [
                'required',
                'string',
            ],

        ]);
    }

}
