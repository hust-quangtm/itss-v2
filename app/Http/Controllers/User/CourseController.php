<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Review;
use App\Models\Tag;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderByDesc('id')->paginate(config('variable.pagination'));
        $teachers = User::where('role_id', User::ROLE['teacher'])->get();
        $tags = Tag::orderByDesc('id')->limit(config('variable.pagination'))->get();
        return view('course', compact('courses', 'teachers', 'tags'));
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        $review = $request->all();
        $review['user_id'] = Auth::id();
        Review::create($review);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $tests = Test::where('course_id', $id)->get();
        $otherCourses = Course::query()->OrderByStudents(Course::ORDER['most'])
        ->limit(config('variable.other_course'))
        ->get();
        $course = Course::findOrfail($id);
        $lessonCourse = Lesson::where([
            ['course_id', '=', $id],
            ['lesson_name', 'LIKE', "%" . $request->name . "%"],
        ])->paginate(config('variable.pagination'));
        $courReviews = $course->reviews;
        $tags = $course->tags;
        $ratingStar = [
            'five_star' => config('variable.five_star'),
            'four_star' => config('variable.four_star'),
            'three_star' => config('variable.three_star'),
            'two_star' => config('variable.two_star'),
            'one_star' => config('variable.one_star')
        ];
        return view('course_detail', compact(['course', 'lessonCourse', 'otherCourses', 'courReviews',
        'ratingStar', 'tags', 'tests']));
    }

    public function search(Request $request)
    {
        $teachers = User::where('role_id', User::ROLE['teacher'])->get();
        $tags = Tag::all();
        $courses = Course::query()->SearchFilter($request)->paginate(config('variable.pagination'));
        $data = [
            'courses' => $courses,
            'teachers' => $teachers,
            'tags'  => $tags,
        ];
        return view('course', $data);
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewRequest $request, $id)
    {
        $review = Review::findOrFail($id);
        $data = $request->all();
        $review->update($data);
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function searchByTag($id)
    {
        $teachers = User::where('role_id', User::ROLE['teacher'])->get();
        $tags = Tag::limit(config('variable.pagination'));
        $courses = Course::query()->orderByDesc('id')
        ->FindByTag($id)->paginate(config('variable.pagination'));
        return view('course', compact('courses', 'teachers', 'tags'));
    }

    public function doTest()
    {
        return view('test');
    }

     /**
     * Write code on Method
     *
     * @return response()
     */

    public function cart(){
        return view('cart');
    }
    /**
     * Write code on Method
     * @return response()
     */

    public function addToCart($id) {
        $course = Course::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
        // $cart[$id]['quantity']++;
            return redirect()->back()->with('success', 'Course added to cart successfully!');
        } else {
            $cart[$id] = [
                "course_name" => $course->course_name,
                "quantity" => 1,
                "price" => $course->price,
                "image" => $course->image
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Course added to cart successfully!');
        }        
    }

    /**
     * Write code on Method
     * @return response()
     */

    public function updateCart(Request $request){
        if($request->id){
            $cart = session()->get('cart');
            // $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     * @return response()
     */

    public function remove(Request $request)  {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Course removed successfully');
        }
    }
}
