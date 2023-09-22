<?php

namespace Tqt97\ModelBlogLaravel\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Tag
{
    public function articles(): BelongsToMany;
}
