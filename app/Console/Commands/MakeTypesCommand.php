<?php

namespace App\Console\Commands;

use Illuminate\Filesystem\Filesystem;

class MakeTypesCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:types {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new types class file';

    /**
     * MakeTypesCommand constructor.
     */
    public function __construct(Filesystem $files)
    {
        // Pass 'Type' as the file type
        parent::__construct($files, 'Type');
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the filename argument
        $filename = $this->argument('filename');

        // Generate the types file
        return $this->generateFile($filename);
    }

    /**
     * Define the file path for the types class.
     *
     * @param string $filename The filename.
     * @return string The file path for the types class.
     */
    protected function getFilePath(string $filename): string
    {
        return app_path("Types/{$filename}.php");
    }

    /**
     * Define the file content for the types class.
     *
     * @param string $filename The filename.
     * @return string The content of the types class file.
     */
    protected function getFileContent(string $filename): string
    {
        return <<<PHP
<?php

namespace App\Types;

use App\Traits\Makeable;

class {$filename} extends BaseType
{
    use Makeable;

    public static function getDefaultPermissions(string \$classname): array
    {
        return [
            //
        ];
    }

    public function setTypes(): array
    {
        return [
            //
        ];
    }

    public function setSelectionTypes(): array
    {
        return [
            //
        ];
    }

    public function setDefaultColors(): array
    {
        return [
            //
        ];
    }
}
PHP;
    }
}
