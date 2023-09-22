<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $tableNames = config('model-blog-laravel.table_names');

        Schema::create($tableNames['articles'], function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignIdFor(App\Models\User::class);
            $table->foreignIdFor(App\Models\Category::class)->nullable();
            $table->string('slug')->unique();
            $table->string('feature_image_url')->nullable();
            $table->mediumText('summary')->nullable();
            $table->longText('body')->nullable();
            $table->string('meta_description')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create($tableNames['categories'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create($tableNames['tags'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create($tableNames['pivot'], function (Blueprint $table) {
            $table->foreignIdFor(App\Models\Article::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(App\Models\Tag::class)->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('fi-blog.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/model-blog-laravel.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::drop($tableNames['articles']);
        Schema::drop($tableNames['categories']);
        Schema::drop($tableNames['tags']);
        Schema::drop($tableNames['pivot']);
    }
};
