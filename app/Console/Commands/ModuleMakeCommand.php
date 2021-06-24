<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ModuleMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Model, Migration, Seeder, Controller, Repository, Service, Provider, View';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $directory = $this->choice('What is directory?', ['Admin', 'Front'], null);

        $resourceName = $this->ask('What is resource name?');

        if ($this->confirm('Do you want to create all resources? (Model, Migration, Seeder, Repository, Service, Controller, Requests, Provider, Views)')) {
            $this->createModel($resourceName);
            $this->createMigration($resourceName);
            $this->createSeeder($resourceName);
            $this->createRepository($resourceName);
            $this->createService($resourceName);
            $this->createController($directory, $resourceName);
            $this->createProvider($resourceName);
           // $this->createViews($directory, $resourceName);
        } else {
            if ($this->confirm('Do you want to create model?')) {
                $this->createModel($resourceName);
            }

            if ($this->confirm('Do you want to create migration?')) {
               $this->createMigration($resourceName);
            }

            if ($this->confirm('Do you want to create seeder?')) {
                $this->createSeeder($resourceName);
            }

            if ($this->confirm('Do you want to create repository')) {
                $this->createRepository($resourceName);
            }

            if ($this->confirm('Do you want to create service')) {
                $this->createService($resourceName);
            }

            if ($this->confirm('Do you want to create controller?')) {
                $this->createController($directory, $resourceName);
            }

            if ($this->confirm('Do you want to create provider?')) {
                $this->createProvider($resourceName);
            }

//            if ($this->confirm('Do you want to create views(from.blade.php, index.blade.php)')) {
//                $this->createViews($directory, $resourceName);
//            }
        }
    }

    /**
     * @param $modelName
     */
    protected function createModel($modelName)
    {
        $this->call('make:module:model', ['name' => $modelName]);

        $this->info("Model created: App/{$modelName}");
    }

    /**
     * @param $migrationName
     */
    protected function createMigration($migrationName)
    {
        $this->call('make:migration', ['name' => 'create_' . Str::plural($migrationName) . '_table', '--create' => Str::plural($migrationName)]);

        $this->info('Migration created: Database/Migrations/..._create_' . Str::plural(lcfirst($migrationName)) . '_table');
    }

    /**
     * @param $seederName
     */
    protected function createSeeder($seederName)
    {
        $this->call('make:module:seeder', ['name' => $seederName. 'Seeder']);

        $this->info("Seeder created: Database/Seeds/{$seederName}Seeder");
    }

    /**
     * @param $repositoryName
     */
    protected function createRepository($repositoryName)
    {
        $this->call('make:module:repository', ['name' => $repositoryName . 'Repository']);

        $this->info("Repository created: App/Repositories/{$repositoryName}Repository");
    }

    /**
     * @param $serviceName
     */
    protected function createService($serviceName)
    {
        $this->call('make:module:service', ['name' => $serviceName. 'Service']);

        $this->info("Service created: App/Services/{$serviceName}Service");
    }

    /**
     * @param string $directory
     * @param string $controllerName
     */
    protected function createController(string $directory, string $controllerName)
    {
        $this->call('make:module:controller', ['name' => "{$directory}/{$controllerName}Controller"]);

        $this->info("Controller created: App/Http/Controllers/{$directory}/{$controllerName}Controller");
    }

    /**
     * @param string $providerName
     */
    protected function createProvider(string $providerName)
    {
        $this->call('make:module:provider', ['name' => $providerName. 'ServiceProvider']);

        $this->info('Provider created: App/Provider'. $providerName. 'ServiceProvider');
    }

    protected function createViews(string $directory, string $viewName)
    {
        $this->call('make:module:view', ['name' => $viewName, 'directory' => $directory]);

        $this->info('View created: App/Resources/Views/'. lcfirst($directory). '/'. lcfirst($viewName). 'form.blade.php');
        $this->info('View created: App/Resources/Views/'. lcfirst($directory). '/'. lcfirst($viewName). 'index.blade.php');
    }
}
