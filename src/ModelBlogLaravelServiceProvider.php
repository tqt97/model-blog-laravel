<?php

namespace Tqt97\ModelBlogLaravel;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tqt97\ModelBlogLaravel\Commands\ModelBlogLaravelCommand;

class ModelBlogLaravelServiceProvider extends PackageServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $this->offerPublishing();
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('model-blog-laravel')
            ->hasConfigFile()
//            ->hasViews()
//            ->hasCommand(ModelBlogLaravelCommand::class)
            ->hasMigration('create_model-blog-laravel_table');
    }

    /**
     * @throws BindingResolutionException
     */
    protected function offerPublishing(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        if (! function_exists('config_path')) {
            // function not available and 'publish' not relevant in Lumen
            return;
        }

        $this->publishes([
            __DIR__.'/../config/permission.php' => config_path('permission.php'),
        ], 'permission-config');

        $this->publishes([
            __DIR__.'/../database/migrations/create_model-blog-laravel_table.php.stub' => $this->getMigrationFileName('create_model-blog-laravel_table.php'),
        ], 'permission-migrations');
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @throws BindingResolutionException
     */
    protected function getMigrationFileName(string $migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make([$this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR])
            ->flatMap(fn ($path) => $filesystem->glob($path.'*_'.$migrationFileName))
            ->push($this->app->databasePath()."/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}
