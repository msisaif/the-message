<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Traits\DateFilter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index()
    {
        $courses = $this->setQuery(Course::query())
            ->search()->filter()
            ->getQuery();

        return Inertia::render('Course/Index', [
            'courses' => CourseResource::collection($courses->paginate(request()->perpage)->onEachSide(1)->appends(request()->input())),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Course/Create', [
            'course' => new Course(),
        ]);
    }

    public function store(Request $request)
    {
        $course = Course::create($this->validateData($request));

        return redirect()
            ->route('courses.show', $course->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Course $course)
    {
        CourseResource::withoutWrapping();

        return Inertia::render('Course/Show', [
            'course' => new CourseResource($course),
        ]);
    }

    public function edit(Course $course)
    {
        return Inertia::render('Course/Edit', [
            'course' => $course,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $course->update($this->validateData($request, $course->id));

        return redirect()
            ->route('courses.show', $course->id)
            ->with('status', 'The record has been update successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()
            ->route('courses.index')
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
