<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use InvalidArgumentException;

class ModuleViewMakeCommand extends Command
{
    const DIRECTORY_TYPE_ADMIN = 'Admin';
    const DIRECTORY_TYPE_FRONT = 'Front';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module:views {name} {directory}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * The views that need to be exported.
     *
     * @var array
     */
    protected $views = [];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $directory = $this->argument('directory');

        if (!in_array($directory, [self::DIRECTORY_TYPE_ADMIN, self::DIRECTORY_TYPE_FRONT])) {
            throw new InvalidArgumentException('Directory type does not exists.');
        }

        if ($directory == self::DIRECTORY_TYPE_ADMIN) {
            $this->views = [
                'views/admin/form-view.stub' => 'views/admin/form-view.stub',
                'views/admin/index-view.stub' => 'views/admin/index-view.stub',
            ];
        }

        $this->ensureDirectoriesExist();
        $this->exportViews();

        $this->appendRoutes();

    }

    /**
     * Create the directories for the files.
     *
     * @return void
     */
    protected function ensureDirectoriesExist()
    {
        if (! is_dir($directory = $this->getViewPath('layouts'))) {
            mkdir($directory, 0755, true);
        }

        if (! is_dir($directory = $this->getViewPath('auth/passwords'))) {
            mkdir($directory, 0755, true);
        }
    }

    /**
     * Export the authentication views.
     *
     * @return void
     */
    protected function exportViews()
    {
        foreach ($this->views as $key => $value) {
            if (file_exists($view = $this->getViewPath($value)) && ! $this->option('force')) {
                if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                __DIR__.'/Auth/'.$this->argument('type').'-stubs/'.$key,
                $view
            );
        }
    }
    protected function appendRoutes()
    {
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/stubs/routes.stub'),
            FILE_APPEND
        );
    }
}
