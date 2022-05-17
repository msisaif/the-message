<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\RamadanChecklistFieldResource;
use App\Models\RamadanChecklistField;
use App\Traits\DateFilter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class RamadanChecklistFieldController extends Controller
{
    public function index()
    {
        $checklist_fields = $this->setQuery(RamadanChecklistField::query())
            ->search()->filter()
            ->getQuery();

        return Inertia::render('RamadanChecklistField/Index', [
            'checklistFields' => RamadanChecklistFieldResource::collection($checklist_fields->paginate(request()->perpage)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        return Inertia::render('RamadanChecklistField/Create', [
            'checklistField' => new RamadanChecklistField(),
        ]);
    }

    public function store(Request $request)
    {
        $checklistField = RamadanChecklistField::create($this->validateData($request));

        return redirect()
            ->route('checklist-fields.show', $checklistField->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(RamadanChecklistField $checklistField)
    {
        RamadanChecklistFieldResource::withoutWrapping();

        return Inertia::render('RamadanChecklistField/Show', [
            'checklistField' => new RamadanChecklistFieldResource($checklistField),
        ]);
    }

    public function edit(RamadanChecklistField $checklistField)
    {
        return Inertia::render('RamadanChecklistField/Edit', [
            'checklistField' => $checklistField,
        ]);
    }

    public function update(Request $request, RamadanChecklistField $checklistField)
    {
        $checklistField->update($this->validateData($request, $checklistField->id));

        return redirect()
            ->route('checklist-fields.show', $checklistField->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(RamadanChecklistField $checklistField)
    {
        $checklistField->delete();

        return redirect()
            ->route('checklist-fields.index')
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
                Rule::unique(RamadanChecklistField::class, 'name')
                    ->whereNull('deleted_at')
                    ->ignore($id),
            ],
            'type' => [
                'required',
            ],
        ]);
    }

}
