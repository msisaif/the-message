<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChecklistFieldResource;
use App\Models\ChecklistField;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ChecklistFieldController extends Controller
{
    public function index()
    {
        $collections = $this->setQuery(ChecklistField::query())
            ->search()->filter()
            ->getQuery();

        return Inertia::render('ChecklistField/Index', [
            'checklistFields' => ChecklistFieldResource::collection($collections->paginate(request()->perpage)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        return Inertia::render('ChecklistField/Create', [
            'checklistField' => new ChecklistField(),
        ]);
    }

    public function store(Request $request)
    {
        $checklistField = ChecklistField::create($this->validateData($request));

        return redirect()
            ->route('checklist-fields.show', $checklistField->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(ChecklistField $checklistField)
    {
        ChecklistFieldResource::withoutWrapping();

        return Inertia::render('ChecklistField/Show', [
            'checklistField' => new ChecklistFieldResource($checklistField),
        ]);
    }

    public function edit(ChecklistField $checklistField)
    {
        return Inertia::render('ChecklistField/Edit', [
            'checklistField' => $checklistField,
        ]);
    }

    public function update(Request $request, ChecklistField $checklistField)
    {
        $checklistField->update($this->validateData($request, $checklistField->id));

        return redirect()
            ->route('checklist-fields.show', $checklistField->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(ChecklistField $checklistField)
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
                Rule::unique(ChecklistField::class, 'name')
                    ->whereNull('deleted_at')
                    ->ignore($id),
            ],
            'type' => [
                'required',
            ],
        ]);
    }

}
