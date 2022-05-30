<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OurCourseController extends Controller
{
    public function index()
    {
        $courses = Course::query()
            ->with('topics.contents')
            ->simplePaginate();

        return Inertia::render('OurCourse/Index', [
            'data' => [
                'courses' => CourseResource::collection($courses),
            ]
        ]);
    }

    public function show(Course $course)
    {
        CourseResource::withoutWrapping();

        $course->load([
            'topics.contents',
            'mentors'
        ]);

        return Inertia::render('OurCourse/Show', [
            'course' => new CourseResource($course),
        ]);
    }
}
