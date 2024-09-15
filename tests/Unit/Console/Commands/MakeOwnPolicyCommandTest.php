<?php

namespace Tests\Unit\Console\Commands;

use App\Console\Commands\MakeOwnPolicyCommand;
use Illuminate\Filesystem\Filesystem;
use Tests\TestCase;
use Mockery;

class MakeOwnPolicyCommandTest extends TestCase
{
    /** @test */
    public function it_creates_a_policy_file_successfully()
    {
        // Arrange: Mock the Filesystem
        $filesystem = Mockery::mock(Filesystem::class);
        $this->app->instance(Filesystem::class, $filesystem);

        $modelName = 'TestModel';
        $filePath = app_path("Policies/{$modelName}Policy.php");

        // Normalize path for assertion
        $normalizedPath = str_replace('\\', '/', $filePath);

        // Expect the file to not exist
        $filesystem->shouldReceive('exists')
            ->once()
            ->with($normalizedPath)
            ->andReturn(false);

        // Expect the file to be written
        $filesystem->shouldReceive('put')
            ->once()
            ->with($normalizedPath, Mockery::type('string'));

        // Act: Run the artisan command
        $this->artisan('make:own-policy', ['model' => $modelName])
            ->expectsOutput("INFO  Policy [{$normalizedPath}] created successfully.")
            ->assertExitCode(0);
    }

    /** @test */
    public function it_shows_error_if_policy_file_already_exists()
    {
        // Arrange
        $filesystem = Mockery::mock(Filesystem::class);
        $this->app->instance(Filesystem::class, $filesystem);

        $modelName = 'TestModel';
        $filePath = app_path("Policies/{$modelName}Policy.php");

        // Normalize path for assertion
        $normalizedPath = str_replace('\\', '/', $filePath);

        // Expect the file to exist, so the command will not create it
        $filesystem->shouldReceive('exists')
            ->once()
            ->with($normalizedPath)
            ->andReturn(true);

        // Act
        $this->artisan('make:own-policy', ['model' => $modelName])
            ->expectsOutput("ERROR  Policy already exists.")
            ->assertExitCode(1);
    }
}
