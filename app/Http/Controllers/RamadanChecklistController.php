<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\RamadanChecklistFieldResource;
use App\Models\RamadanChecklist;
use App\Models\RamadanChecklistField;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RamadanChecklistController extends Controller
{
    public function list()
    {
        // return
        $user = User::find(Auth::id()) ?? null;

        $userChecklist = $user ? $user->ramadan_checklists()->get() : [];

        return Inertia::render('RamadanChecklist/Index', [
            'data' => [
                'ramadanCheckListFields' => $this->getRamadanChecklistField(),
                'userChecklist' => $userChecklist,
            ]
        ]);
    }

    public function form($date = "")
    {
        if(!$date) {
            $date = date("Y-m-d");
            if(!in_array($date, $this->getRamadanDate())) {
                $date = $this->getRamadanDate()[0];
            }

            return Redirect::route('ramadan-checklist.form', $date);
        }

        $ramadanChecklist = RamadanChecklist::query()
            ->where([
                'user_id' => Auth::id(),
                'date' => $date,
            ])
            ->first();

        return Inertia::render('RamadanChecklist/Create', [
            'data' => [
                'ramadanCheckListFields' => $this->getRamadanChecklistField(),
                'selectedDate' => $date,
                'selectedRamadanChecklist' => $ramadanChecklist ? $ramadanChecklist->checklist : [],
            ]
        ]);
    }

    protected function getRamadanDate() {
        return [
            "2022-04-23",
            "2022-04-24",
            "2022-04-25",
            "2022-04-26",
            "2022-04-27",
            "2022-04-28",
            "2022-04-29",
            "2022-04-30",
            "2022-05-01",
            "2022-05-02",
        ];
    }

    public function save(Request $request)
    {
        $checklist = RamadanChecklist::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'date' => $request->date,
            ],
            [
                'checklist' => json_encode($request->checklist),
                'title' => $request->title,
            ]
        );

        return redirect()
            ->route('ramadan-checklist.list')
            ->with('status', 'The record has been added successfully.');
    }

    protected function getRamadanChecklistField()
    {
        RamadanChecklistFieldResource::withoutWrapping();

        $ramadan_checklist_fields = RamadanChecklistField::get();

        return RamadanChecklistFieldResource::collection($ramadan_checklist_fields);
    }
}
