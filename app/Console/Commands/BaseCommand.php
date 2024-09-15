<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

/**
 * BaseCommand is an abstract class that provides the common structure
 * and functionality for commands that generate files dynamically.
 * The $fileType variable allows customization of the file type (e.g., Policy, Type).
 */
abstract class BaseCommand extends Command
{
    /**
     * The Filesystem instance used to handle file operations.
     *
     * @var Filesystem
     */
    protected Filesystem $files;

    /**
     * The type of file being created (e.g., 'Policy', 'Type').
     *
     * @var string
     */
    private string $fileType;

    /**
     * The exit codes for success and error.
     * These are used to determine the exit code of the command.
     * The command will exit with EXIT_SUCCESS_CODE on success and EXIT_ERROR_CODE on error.
     * 
     * @var int
     */
    private const EXIT_ERROR_CODE = 1;
    private const EXIT_SUCCESS_CODE = 0;

    /**
     * BaseCommand constructor.
     *
     * @param Filesystem $files The Filesystem instance for file operations.
     * @param string $fileType The type of file being created (e.g., 'Policy', 'Type').
     */
    public function __construct(Filesystem $files, string $fileType)
    {
        parent::__construct();
        $this->files = $files;
        $this->fileType = $fileType;
    }

    /**
     * Abstract method to define the file path for the generated class.
     *
     * @param string $name The name of the file.
     * @return string The file path where the class will be generated.
     */
    abstract protected function getFilePath(string $name): string;

    /**
     * Abstract method to define the content for the generated class file.
     *
     * @param string $name The name of the file.
     * @return string The content that will be written to the class file.
     */
    abstract protected function getFileContent(string $name): string;

    /**
     * Method to generate the class file.
     *
     * @param string $name The name of the file being created.
     * @return void
     */
    public function generateFile(string $name): int
    {
        $path = $this->getFilePath($name);

        // Normalize path for output
        $normalizedPath = Str::replace('\\', '/', $path);

        // Check if the file already exists
        if ($this->files->exists($normalizedPath)) {
            $this->error("ERROR  {$this->fileType} already exists.");
            return self::EXIT_ERROR_CODE;
        }

        // Get the file content
        $content = $this->getFileContent($name);

        // Write the file
        $this->files->put($normalizedPath, $content);

        // Output success message
        $this->info("INFO  {$this->fileType} [{$normalizedPath}] created successfully.");

        return self::EXIT_SUCCESS_CODE;
    }
}
