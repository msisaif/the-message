<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\MentorResource;
use App\Models\Content;
use App\Models\Course;
use App\Models\CourseMentor;
use App\Models\Mentor;
use App\Models\Topic;
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
        CourseResource::withoutWrapping();
        MentorResource::withoutWrapping();

        return Inertia::render('Course/Create', [
            'course'    => new CourseResource(new Course()),
            'mentors'   => MentorResource::collection(Mentor::get()),
        ]);
    }

    public function store(Request $request)
    {
        $course = Course::create($this->validateData($request));

        $this->saveCourseMentor($course, $request);

        return redirect()
            ->route('courses.show', $course->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Course $course)
    {
        CourseResource::withoutWrapping();

        $course->load('mentors');

        return Inertia::render('Course/Show', [
            'course' => new CourseResource($course),
        ]);
    }

    public function edit(Course $course)
    {
        CourseResource::withoutWrapping();
        MentorResource::withoutWrapping();

        $course->load('mentors');
        
        if(request()->step == 'content') {
            $course->load('topics.contents');
        }

        if(request()->step == 'publish') {
            $course->load('topics.contents');
        }

        // return new CourseResource($course);

        return Inertia::render('Course/Edit', [
            'course'    => new CourseResource($course),
            'mentors'   => MentorResource::collection(Mentor::get()),
            'step'      => request()->step ?? "",
        ]);
    }

    public function update(Request $request, Course $course)
    {
        if($request->step == "content") {
            $this->saveCourseTopicWithTopicContent($course, $request);
        }

        if($request->step == "publish") {
            $course->update([
                'publish' => (boolean) $request->publish,
            ]);
        }

        if(!$request->step) {
            $course->update($this->validateData($request, $course->id));

            $this->saveCourseMentor($course, $request);
        }

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
            'title' => [
                'required',
                'string',
            ],
            'amount' => [
                'required',
                'numeric',
            ],
            'description' => [],
            'video' => [],
        ]);
    }

    protected function saveCourseMentor($course, $request)
    {
        CourseMentor::query()
            ->where('course_id', $course->id)
            ->delete();

        if(is_array($request->mentor_ids)) {
            foreach($request->mentor_ids as $mentor_id) {
                CourseMentor::onlyTrashed()->updateOrCreate(
                    [],
                    [
                        'course_id'     => $course->id,
                        'mentor_id'     => $mentor_id,
                        'deleted_at'    => NULL,
                    ]
                );
            }
        }
    }

    protected function saveCourseTopicWithTopicContent($course, $request)
    {
        Topic::query()
            ->where('course_id', $course->id)
            ->delete();

        if(is_array($request->topics)) {
            foreach($request->topics as $request_topic) {
                $topic = Topic::onlyTrashed()->updateOrCreate(
                    [],
                    [
                        'course_id'     => $course->id,
                        'title'         => $request_topic["title"],
                        'deleted_at'    => NULL,
                    ]
                );

                $this->saveTopicContent($topic, $request_topic["contents"]);
            }
        }
    }

    protected function saveTopicContent($topic, $contents)
    {
        Content::query()
            ->where('topic_id', $topic->id)
            ->delete();

        if(is_array($contents)) {
            foreach($contents as $content) {
                Content::onlyTrashed()->updateOrCreate(
                    [],
                    [
                        'topic_id'      => $topic->id,
                        'title'         => $content["title"],
                        'type'          => $content["type"],
                        'link'          => $content["link"],
                        'deleted_at'    => NULL,
                    ]
                );
            }
        }
    }

}
