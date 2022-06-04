<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContentResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\ParticipantResource;
use App\Models\Content;
use App\Models\Course;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OurCourseController extends Controller
{
    public function index()
    {
        $courses = Course::query()
            ->published()
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
        if(!$course->publish) {
            return abort(404);
        }

        if($user = Auth::user()) {
            $participant = Participant::query()
                ->where([
                    'user_id'   => $user->id,
                    'course_id' => $course->id,
                ])
                ->first();
    
            if($participant) {
                return redirect()->route('course.learn', $course->id);
            }
        }

        CourseResource::withoutWrapping();

        $course->load([
            'topics.contents',
            'mentors'
        ]);

        return Inertia::render('OurCourse/Show', [
            'course' => new CourseResource($course),
        ]);
    }

    public function enroll(Course $course)
    {
        if(!$course->publish) {
            return abort(404);
        }

        $user = Auth::user();

        $data = [
            'user_id'   => $user->id,
            'course_id' => $course->id,
        ];

        $participant = Participant::where($data)->first();

        if($participant) {
            return redirect()->route('course.learn', $course->id);
        }

        if($course->amount) {
            return "Coming Soon...";
        }

        $participant = Participant::create($data);

        return redirect()->route('course.learn', $course->id);
    }

    public function learn(Course $course, $content_id = null)
    {
        $user = Auth::user();

        $data = [
            'user_id'   => $user->id,
            'course_id' => $course->id,
        ];

        $participant = Participant::where($data)->first();

        if(!$participant) {
            return redirect()->route('course.show', $course->id);
        }

        CourseResource::withoutWrapping();

        $course->load([
            'topics.contents',
            'mentors'
        ]);

        $content = new Content();

        $total_course_content = Content::query()
            ->whereHas('topic', function($query) use ($course) {
                $query->where('course_id', $course->id);
            })
            ->count();

        if($total_course_content) {
            $current_content_id = $content_id;

            do {
                $content = Content::query()
                    ->whereHas('topic', function($query) use ($course) {
                        $query->where('course_id', $course->id);
                    })
                    ->when($current_content_id, function($query, $content_id) {
                        $query->where('id', $content_id);
                    })
                    ->first();

                $content_id = $current_content_id;
                $current_content_id = null;
            } while (!$content);

            if(!$content_id) {
                return redirect()->route('course.learn', [$course->id, $content->id]);
            }
        }

        if($content->link ?? false) {
            // View count
        }

        return Inertia::render('OurCourse/Learn', [
            'course'            => new CourseResource($course),
            'currentContent'    => new ContentResource($content),
        ]);
    }

    public function myCourse()
    {
        $user = User::findOrFail(Auth::id());

        $participants = $user->participants()->with('course')->latest()->simplePaginate(20);

        return Inertia::render('MyCourse/Index', [
            'participants' => ParticipantResource::collection($participants),
        ]);
    }
}
