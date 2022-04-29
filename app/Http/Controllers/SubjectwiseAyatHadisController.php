<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Subjectwise;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubjectwiseAyatHadisController extends Controller
{
    public function index()
    {
        return Inertia::render('SubjectwiseAaytHadis/Index', [
            'categories' => CategoryResource::collection(Category::get())
        ]);
    }

    public function show(Category $category)
    {
        $ayah_list = Subjectwise::query()
            ->where('category_id', $category->id)
            ->ayah()
            ->get();

        $hadith_list = Subjectwise::query()
            ->where('category_id', $category->id)
            ->hadith()
            ->get();


        return Inertia::render('SubjectwiseAaytHadis/Show', [
            'data' => [
                'category'      => $category,
                'ayahList'      => $ayah_list,
                'hadithList'    => $hadith_list,
            ],
        ]);
    }
}
