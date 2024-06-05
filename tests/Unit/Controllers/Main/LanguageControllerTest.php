<?php

namespace Controllers\Main;

use App\Http\Controllers\Main\LanguageController;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    public function testSetLanguage()
    {
        // Arrange
        $lang = 'en';

        Log::shouldReceive('info')
            ->once()
            ->with("Setting language to: " . $lang);

        // Act
        $controller = new LanguageController();
        $response = $controller->set($lang);

        // Assert
        $this->assertEquals(session('applocale'), $lang);
        $this->assertTrue($response->isRedirection());
    }

    public function testSetLanguageShq()
    {
        // Arrange
        $lang = 'shq';

        Log::shouldReceive('info')
            ->once()
            ->with("Setting language to: " . $lang);

        // Act
        $controller = new LanguageController();
        $response = $controller->set($lang);

        // Assert
        $this->assertEquals(session('applocale'), $lang);
        $this->assertTrue($response->isRedirection());
    }

    public function testSetLanguageMk()
    {
        // Arrange
        $lang = 'mk';

        Log::shouldReceive('info')
            ->once()
            ->with("Setting language to: " . $lang);

        // Act
        $controller = new LanguageController();
        $response = $controller->set($lang);

        // Assert
        $this->assertEquals(session('applocale'), $lang);
        $this->assertTrue($response->isRedirection());
    }
}
