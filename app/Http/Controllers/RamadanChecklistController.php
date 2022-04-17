<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\RamadanChecklistFieldResource;
use App\Models\RamadanChecklist;
use App\Models\RamadanChecklistField;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RamadanChecklistController extends Controller
{
    public function index()
    {
        RamadanChecklistFieldResource::withoutWrapping();

        $ramadan_checklist_fields = RamadanChecklistField::get();

        $ramadan_checklist_fields = RamadanChecklistFieldResource::collection($ramadan_checklist_fields);

        return Inertia::render('RamadanReport/Index', [
            'data' => [
                'ramadanCheckListFields' => $ramadan_checklist_fields
            ]
        ]);
    }

    public function create()
    {
        
    }
}
