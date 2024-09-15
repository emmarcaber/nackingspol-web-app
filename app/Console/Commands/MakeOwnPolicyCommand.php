<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeOwnPolicyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:own-policy {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new policy class file';

    protected Filesystem $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle(Filesystem $files)
    {
        // Get the model argument
        $model = $this->argument('model');
        $path = app_path("Policies/{$model}Policy.php");

        // Check if the file already exists
        if ($this->files->exists($path)) {
            $this->error("ERROR  Policy already exists.");
            return;
        }

        // Define the file content
        // Do not indent since it will be written to the file as is
        $content = <<<PHP
<?php

namespace App\Policies;

use App\Models\\$model;
use App\Models\User;

class {$model}Policy extends BasePolicy
{
    public function model(): string
    {
        return {$model}::class;
    }
}
PHP;

        // Write the file
        $this->files->put($path, $content);

        // Create the file and write the content
        $this->files->put($path, $content);

        $this->info("INFO  Policy [{$path}] created successfully.");
    }
}
