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
    //    public function boot()
    //    {
    //        $this->offerPublishing();
    //    }

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

        //        $this->publishes([
        //            __DIR__ . '/Models/Article.php' => $this->app->app_path() . '/models/Article.php']);

        $this->publishes([
            __DIR__.'/Models/Article.php' => $this->getModelFileName('Article.php'),
        ]);
        $this->publishes([
            __DIR__.'/Models/Category.php' => $this->getModelFileName('Category.php'),
        ]);
        $this->publishes([
            __DIR__.'/Models/Tag.php' => $this->getModelFileName('Tag.php'),
        ]);

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

    protected function getModelFileName(string $modelFileName): string
    {
        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make([$this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR])
            ->flatMap(fn ($path) => $filesystem->glob($path.'*_'.$modelFileName))
            ->push(app_path()."/Models/{$modelFileName}")
            ->first();
    }

    //    protected function registerModelBindings(): void
    //    {
    //        $this->app->bind(Tqt97\ModelBlogLaravel\Contracts\ArticleContract::class, fn ($app) => $app->make($app->config['model-blog-laravel.models.article']));
    //        $this->app->bind(Tqt97\ModelBlogLaravel\Contracts\CategoryContract::class, fn ($app) => $app->make($app->config['model-blog-laravel.models.category']));
    //        $this->app->bind(Tqt97\ModelBlogLaravel\Contracts\TagContract::class, fn ($app) => $app->make($app->config['model-blog-laravel.models.tag']));
    //    }
}
