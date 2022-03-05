<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\JuzResource;
use App\Http\Resources\SuraResource;
use App\Models\Ayah;
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
            'suras' => SuraResource::collection($suras->paginate(request()->perpage)->onEachSide(1)->appends(request()->input())),
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

        return Inertia::render('Sura/Create', [
            'data' => [
                'sura' => new Sura(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        if(Sura::count() >= 114) {
            return redirect()
                ->route('suras.index')
                ->with('status', '114 Sura has already been created.');
        }

        $sura = Sura::create($this->validateData($request));

        // $this->addAyah($sura);

        return redirect()
            ->route('suras.show', $sura->id)
            ->with('status', 'The record has been added successfully.');
    }

    private function addAyah($sura) {
        $data = [];

        for($i = 1; $i <= $sura->total_ayah; $i++) {
            $data[] = [
                'sura_number'   => $sura->sura_number,
                'position'      => $i,
                'key'           => "{$sura->sura_number}:{$i}"
            ];
        }

        // return $data;

        Ayah::insert($data);
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
        return Inertia::render('Sura/Edit', [
            'data' => [
                'sura' => $sura,
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
            'bengali_pronunciation' => [
                'required',
                'string',
            ],
            'english_pronunciation' => [
                'required',
                'string',
            ],
            'bengali_meaning' => [
                'required',
                'string',
            ],
            'english_meaning' => [
                'required',
                'string',
            ],

        ]);
    }

}
