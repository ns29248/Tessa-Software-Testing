<?php

namespace Controllers\Main;

use App\Http\Controllers\Main\CoursesController;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\View\View;
use Tests\TestCase;

class CoursesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        // Arrange
        $courses = Course::factory()->count(3)->create();

        $controller = new CoursesController();

        // Act
        $response = $controller->index();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('main.courses.course', $response->getName());
        $this->assertArrayHasKey('courses', $response->getData());
        $this->assertCount(3, $response->getData()['courses']);
    }

    public function testShow()
    {
        // Arrange
        $course = Course::factory()->create();
        $relatedCourses = Course::factory()->count(3)->create();

        $controller = new CoursesController();

        // Act
        $response = $controller->show($course);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('main.courses.show-course', $response->getName());
        $this->assertArrayHasKey('course', $response->getData());
        $this->assertArrayHasKey('relatedCourses', $response->getData());
        $this->assertCount(3, $response->getData()['relatedCourses']);
    }
}
