<?php

namespace Tqt97\ModelBlogLaravel\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


interface Article
{

    public function author(): BelongsTo;
    public function category(): BelongsTo;
    public function tags(): BelongsToMany;

}
