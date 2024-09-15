<?php

namespace App\Console\Commands;

use Illuminate\Filesystem\Filesystem;

class MakeOwnPolicyCommand extends BaseCommand
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

    /**
     * MakeOwnPolicyCommand constructor.
     */
    public function __construct(Filesystem $files)
    {
        // Pass 'Policy' as the file type
        parent::__construct($files, 'Policy');
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the model argument
        $model = $this->argument('model');

        // Generate the policy file
        return $this->generateFile($model);
    }

    /**
     * Define the file path for the policy class.
     *
     * @param string $model The model name.
     * @return string The file path for the policy.
     */
    protected function getFilePath(string $model): string
    {
        return app_path("Policies/{$model}Policy.php");
    }

    /**
     * Define the file content for the policy class.
     *
     * @param string $model The model name.
     * @return string The content of the policy class file.
     */
    protected function getFileContent(string $model): string
    {
        return <<<PHP
<?php

namespace App\Policies;

use App\Models\\$model;

class {$model}Policy extends BasePolicy
{
    public function model(): string
    {
        return {$model}::class;
    }
}
PHP;
    }
}
