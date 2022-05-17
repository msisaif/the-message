<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChecklistFieldResource;
use App\Http\Resources\RamadanChecklistFieldResource;
use App\Models\Checklist;
use App\Models\RamadanChecklistField;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ChecklistController extends Controller
{
    public function list($year = null, $month = null)
    {
        if(!$year || !$month) {
            $year = $year ?? date('Y');
            $month = $month ?? date('m');

            return redirect()->route('checklist.list', [$year, $month]);
        }
        
        $user = User::find(Auth::id()) ?? null;

        $checklist = $user ? $user->checklists()->get() : [];

        return Inertia::render('Checklist/Index', [
            'data' => [
                'checkListFields'   => $this->getChecklistField(),
                'checkListColumns'  => $this->getCheckListColumn($year, $month),
                'userChecklist'     => $checklist,
                'prevMonth'         => $this->getPrevMonthData($year, $month),
                'nextMonth'         => $this->getNextMonthData($year, $month),
                'currentMonth'      => $this->getCurrentMonthData($year, $month),
                'year'              => $year,
                'month'             => $month,
            ]
        ]);
    }

    protected function getCurrentMonthData($year, $month)
    {
        $day = 1;
        $tz = 'Asia/Dhaka';

        $date = Carbon::createFromDate($year, $month, $day, $tz);

        return [
            'title' => $date->format("M Y"),
            'value' => [
                $date->format("Y"),
                $date->format("m")
            ],
        ];
    }

    protected function getPrevMonthData($year, $month)
    {
        $day = 1;
        $tz = 'Asia/Dhaka';

        $date = Carbon::createFromDate($year, $month, $day, $tz);
        $date = $date->subMonth();

        return [
            'title' => $date->format("M Y"),
            'value' => [
                $date->format("Y"),
                $date->format("m")
            ],
        ];
    }

    protected function getNextMonthData($year, $month)
    {
        $day = 1;
        $tz = 'Asia/Dhaka';

        $date = Carbon::createFromDate($year, $month, $day, $tz);
        $date = $date->addMonth();

        return [
            'title' => $date->format("M Y"),
            'value' => [
                $date->format("Y"),
                $date->format("m")
            ],
        ];
    }

    protected function getCheckListColumnFormat($year, $month)
    {
        $day = 1;
        $tz = 'Asia/Dhaka';

        $date = Carbon::createFromDate($year, $month, $day, $tz);

        $data = Array();

        for($i = 1; $i <= $date->endOfMonth()->format("d"); $i++) {
            $data[] = [
                'title' => $i . $date->format(" M Y"),
                'date'  => $date->format("Y-m-") . $i,
            ];
        }

        return $data;
    }

    protected function getCheckListColumn($year, $month)
    {
        $day = 1;
        $tz = 'Asia/Dhaka';

        $date = Carbon::createFromDate($year, $month, $day, $tz);

        $data = Array();

        for($i = 1; $i <= $date->endOfMonth()->format("d"); $i++) {
            $data[] = [
                'title' => $i,
                'date'  => $date->format("Y-m-") . $i,
            ];
        }

        return $data;
    }

    public function form($date = "")
    {
        if(!$date) {
            $date = date("Y-m-d");

            return Redirect::route('checklist.form', $date);
        }

        $ramadanChecklist = Checklist::query()
            ->where([
                'user_id' => Auth::id(),
                'date' => $date,
            ])
            ->first();

        $year = explode('-', $date)[0];
        $month = explode('-', $date)[1];

        return Inertia::render('Checklist/Create', [
            'data' => [
                'ramadanCheckListFields' => $this->getRamadanChecklistField(),
                'checkListColumns'  => $this->getCheckListColumnFormat($year, $month),
                'selectedDate' => $date,
                'selectedRamadanChecklist' => $ramadanChecklist ? $ramadanChecklist->checklist : [],
            ]
        ]);
    }

    public function save(Request $request)
    {
        $checklist = Checklist::updateOrCreate(
            [
                'user_id'       => Auth::id(),
                'date'          => $request->date,
            ],
            [
                'checklist'     => json_encode($request->checklist),
                'deleted_at'    => null,
            ]
        );

        return redirect()
            ->route('checklist.list')
            ->with('status', 'The record has been added successfully.');
    }

    protected function getChecklistField()
    {
        ChecklistFieldResource::withoutWrapping();

        $checklist_fields = RamadanChecklistField::get();

        return ChecklistFieldResource::collection($checklist_fields);
    }
}
