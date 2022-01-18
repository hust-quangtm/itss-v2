<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\CourseTag;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = Course::query();
        if ($request->name) {
            $courses->where('course_name', 'like', '%' . $request->name . '%');
        }

        $courses = $courses->orderByDesc('id')->paginate(config('variable.pagination_admin'));
        $data = [
            'courses' => $courses,
        ];
        return view('admin.course.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $data = [
            'tags' => $tags,
        ];
        return view('admin.course.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $image = uniqid() . "_" . $request->image->getClientOriginalName();
            $request->file('image')->storeAs(config('variable.storage_image'), $image);
        }

        DB::beginTransaction();
        try {
            Course::create([
                'course_name' => $request->course_name,
                'description' => $request->description,
                'requirement' => $request->requirement,
                'price' => $request->price,
                'image' => $image,
                'teacher_id' => Auth::guard('admin')->user()->id,
            ]);

            $course = Course::where('course_name', $request->course_name)->first();
            $tagArray = $request->tagId;
            if (!empty($tagArray)) {
                $course->tag()->attach($tagArray);
            }

            if (Auth::guard('admin')->user()->id == 2) {
                $user = User::findOrFail(Auth::guard('admin')->user()->id);
                $user['avatar'] = $createCourseTime - 1;
                $user->update($user);
            }

            DB::commit();

            return redirect()->route('admin.courses.index')->with('message', __('messages.create_message'));
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());

            return redirect()->route('admin.courses.index')->with('message', __('messages.create_message_error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courses = Course::findOrFail($id);
        $tags = Tag::all();
        $courseTag = $courses->tags;
        $data = [
            'courses' => $courses,
            'tags' => $tags,
            'courseTag' => $courseTag,
        ];
        return view('admin.course.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $courses = Course::findOrFail($id);
            if ($request->hasFile('image')) {
                $image = uniqid() . "_" . $request->image->getClientOriginalName();
                $request->file('image')->storeAs(config('variable.storage_image'), $image);
                $imageDelete = Course::find($id)->image;
                Storage::delete(config('variable.storage_image') . $imageDelete);
                $data['image'] = $image;
            }

            $courses->update($data);

            $tagArray = $request->tagId;
            if (!empty($tagArray)) {
                CourseTag::whereIn('course_id', [$courses->id])->delete();
                $courses->tag()->attach($tagArray);
            }

            DB::commit();

            return redirect()->route('admin.courses.index')->with('message', __('messages.update_message'));
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());

            return redirect()->route('admin.courses.index')->with('message', __('messages.update_message_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $lesson = Lesson::whereIn("course_id", [$course->id])->get();
        if (count($lesson) == 0) {
            $courseImage = $course->image;
            Storage::delete(config('variable.storage_image') . $courseImage);
            CourseTag::whereIn("course_id", [$course->id])->delete();
            $course->delete();
            return redirect()->back()->with('message', __('messages.delete_message'));
        } else {
            return redirect()->back()->with('message', __('messages.delete_message_error'));
        }
    }

    public function searchByTag(Request $request, $id)
    {
        $courses = Course::query();
        if ($request->name) {
            $courses->where('course_name', 'like', '%' . $request->name . '%');
        }

        $courses = $courses->orderByDesc('id')->FindByTag($id)->paginate(config('variable.pagination_admin'));
        $data = [
            'courses' => $courses,
        ];
        return view('admin.course.index', $data);
    }
}
