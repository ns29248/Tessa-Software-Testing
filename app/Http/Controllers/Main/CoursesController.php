<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller; // Correct the namespace
use App\Models\Course;
use App\Services\CouponService;

class CoursesController extends Controller
{
    protected $couponService;
    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function index()
    {
        // Retrieve the courses from the database
        $courses = Course::all();

        // Pass the courses to the view
        return view('main.courses.course', compact('courses'));
    }

    public function show(Course $course)
    {
        $relatedCourses = Course::with('image')
            ->where('id', '!=', $course->id)
            ->get();
        return view('main.courses.show-course', compact('course','relatedCourses'));
    }
}
