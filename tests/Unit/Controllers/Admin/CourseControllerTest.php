<?php

namespace Tests\Unit\Controllers\Admin;

use App\Http\Controllers\Admin\CourseController;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Image;
use App\Services\CourseService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $courseService;
    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->courseService = Mockery::mock(CourseService::class);
        $this->controller = new CourseController($this->courseService);
    }

    public function testIndex()
    {
        $courses = Course::factory()->count(3)->make();
        $this->courseService->shouldReceive('getAllCourses')->once()->andReturn($courses);

        $response = $this->controller->index();

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.course', $response->getName());
        $this->assertArrayHasKey('courses', $response->getData());
        $this->assertEquals($courses, $response->getData()['courses']);
    }

    public function testStore()
    {
        $request = Mockery::mock(CourseRequest::class);
        $request->shouldReceive('validated')->andReturn(['name' => 'Test Course']);
        $request->shouldReceive('input')->with('images')->andReturn(null);

        $this->courseService->shouldReceive('createCourse')->once()->with(['name' => 'Test Course'], null)->andReturn(true);

        $response = $this->controller->store($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('Course added successfully.', session('message'));
    }

    public function testStoreException()
    {
        $request = Mockery::mock(CourseRequest::class);
        $request->shouldReceive('validated')->andReturn(['name' => 'Test Course']);
        $request->shouldReceive('input')->with('images')->andReturn(null);

        $this->courseService->shouldReceive('createCourse')->once()->andThrow(new \Exception('Test Exception'));

        $response = $this->controller->store($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('Error adding course: Test Exception', session('error'));
    }

    public function testShow()
    {
        $course = Course::factory()->make();

        $response = $this->controller->show($course);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.show-courses', $response->getName());
        $this->assertArrayHasKey('course', $response->getData());
        $this->assertEquals($course, $response->getData()['course']);
    }

    public function testEdit()
    {
        $course = Course::factory()->make();

        $response = $this->controller->edit($course);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.edit-course', $response->getName());
        $this->assertArrayHasKey('course', $response->getData());
        $this->assertEquals($course, $response->getData()['course']);
    }

    public function testUpdate()
    {
        $course = Course::factory()->make();
        $request = Mockery::mock(CourseRequest::class);
        $request->shouldReceive('validated')->andReturn(['name' => 'Updated Course']);
        $request->shouldReceive('input')->with('images')->andReturn(null);

        $this->courseService->shouldReceive('updateCourse')->once()->with($course, ['name' => 'Updated Course'], null)->andReturn(true);

        $response = $this->controller->update($request, $course);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('Course updated successfully.', session('message'));
    }

    public function testUpdateException()
    {
        $course = Course::factory()->make();
        $request = Mockery::mock(CourseRequest::class);
        $request->shouldReceive('validated')->andReturn(['name' => 'Updated Course']);
        $request->shouldReceive('input')->with('images')->andReturn(null);

        $this->courseService->shouldReceive('updateCourse')->once()->andThrow(new \Exception('Test Exception'));

        $response = $this->controller->update($request, $course);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('Error updating course: Test Exception', session('error'));
    }

    public function testDestroy()
    {
        $course = Course::factory()->make();

        $this->courseService->shouldReceive('deleteCourse')->once()->with($course)->andReturn(true);

        $response = $this->controller->destroy($course);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('Course deleted successfully.', session('success'));
    }

    public function testDestroyException()
    {
        $course = Course::factory()->make();

        $this->courseService->shouldReceive('deleteCourse')->once()->with($course)->andThrow(new \Exception('Test Exception'));

        $response = $this->controller->destroy($course);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('Failed to delete course: Test Exception', session('error'));
    }

    public function testDestroyImage()
    {
        $imageName = '1706084615'. '.webp';

        // Create and associate an image with the product
        $course = Course::factory()->make();
        $image = new Image(['id' => 1, 'name' => $imageName]);

        $this->courseService->shouldReceive('deleteImage')->once()->with($image)->andReturn(true);

        $response = $this->controller->destroyImage($course, $image);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('Image deleted successfully.', session('message'));
    }

    public function testDestroyImageException()
    {
        $imageName = '1706084615'. '.webp';

        // Create and associate an image with the product
        $course = Course::factory()->make();
        $image = new Image(['id' => 1, 'name' => $imageName]);

        $this->courseService->shouldReceive('deleteImage')->once()->with($image)->andThrow(new \Exception('Test Exception'));

        $response = $this->controller->destroyImage($course, $image);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('Failed to delete image: Test Exception', session('error'));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
