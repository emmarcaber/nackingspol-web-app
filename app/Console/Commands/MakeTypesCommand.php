<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeTypesCommand extends Command
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

    protected Filesystem $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the filename argument
        $filename = $this->argument('filename');
        $path = app_path("Types/{$filename}.php");

        // Check if the file already exists
        if ($this->files->exists($path)) {
            $this->error("ERROR  Type already exists.");
            return;
        }

        // Define the file content
        // Do not indent since it will be written to the file as is
        $content = <<<PHP
<?php

namespace App\Types;

use App\Traits\Makeable;

class {$filename}Type extends BaseType
{
    use Makeable;

    public static function getDefaultPermissions(string \$classname) : array
    {
        return [
            //
        ];
    }

    public function setTypes() : array
    {
        return [
            //
        ];
    }

    public function setSelectionTypes() : array
    {
        return [
            //
        ];
    }

    public function setDefaultColors() : array
    {
        return [
            //
        ];
    }
}
PHP;

        // Create the file and write the content
        $this->files->put($path, $content);

        $this->info("INFO  Type [{$path}] created successfully.");
    }
}
