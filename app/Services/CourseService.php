<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Exception;

class CourseService
{
    public function getAllCourses()
    {
        return Course::all();
    }

    public function createCourse($data, $imageNames = null)
    {
        DB::beginTransaction();

        try {
            $course = Course::create($data);

            if ($imageNames) {
                $this->attachImagesToCourse($course, $imageNames);
            }

            DB::commit();
            return $course;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Failed to add course: ' . $e->getMessage());
        }
    }

    public function updateCourse(Course $course, $data, $imageNames = null)
    {
        DB::beginTransaction();

        try {
            $course->update($data);

            if ($imageNames) {
                // Optionally, clear old images if needed
                // $course->image()->delete();

                $this->attachImagesToCourse($course, $imageNames);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Failed to update course: ' . $e->getMessage());
        }
    }

    private function attachImagesToCourse($course, $imageNames)
    {
        $imageRecords = collect($imageNames)->map(function ($imageName) use ($course) {
            return [
                'name' => $imageName,
                'imageable_id' => $course->id,
                'imageable_type' => get_class($course),
            ];
        });

        $course->image()->createMany($imageRecords->toArray());
    }

    public function deleteCourse(Course $course)
    {
        try {
            $course->image()->delete();
            $course->delete();
        } catch (Exception $e) {
            throw new Exception('Failed to delete course: ' . $e->getMessage());
        }
    }

    public function deleteImage(Image $image)
    {
        // Optionally, delete the image file from storage if needed
        // Storage::delete('public/images/' . $image->name);

        $image->delete();
    }
}

