<?php

namespace Tqt97\ModelBlogLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tqt97\ModelBlogLaravel\Commands\ModelBlogLaravelCommand;

class ModelBlogLaravelServiceProvider extends PackageServiceProvider
{
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
            ->hasViews()
            ->hasMigration('create_model-blog-laravel_table')
            ->hasCommand(ModelBlogLaravelCommand::class);
    }
}
