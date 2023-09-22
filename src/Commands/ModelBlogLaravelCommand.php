<?php

namespace Tqt97\ModelBlogLaravel\Commands;

use Illuminate\Console\Command;

class ModelBlogLaravelCommand extends Command
{
    public $signature = 'model-blog-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
