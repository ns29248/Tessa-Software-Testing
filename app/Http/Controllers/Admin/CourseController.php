<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Image;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = $this->courseService->getAllCourses();
        return view('admin.course', compact('courses'));
    }

    public function store(CourseRequest $request)
    {
        try {
            $this->courseService->createCourse($request->validated(), $request->input('images'));
            return redirect()->back()->with('message', 'Course added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding course: ' . $e->getMessage());
        }
    }

    public function show(Course $course)
    {
        return view('admin.show-courses', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.edit-course', compact('course'));
    }

    public function update(CourseRequest $request, Course $course)
    {
        try {
            $this->courseService->updateCourse($course, $request->validated(), $request->input('images'));
            return redirect()->back()->with('message', 'Course updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating course: ' . $e->getMessage());
        }
    }

    public function destroy(Course $course)
    {
        try {
            $this->courseService->deleteCourse($course);
            return redirect()->back()->with('success', 'Course deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete course: ' . $e->getMessage());
        }
    }

    public function destroyImage(Course $course, Image $image)
    {
        try {
            $this->courseService->deleteImage($image);
            return redirect()->back()->with('message', 'Image deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete image: ' . $e->getMessage());
        }
    }
}

