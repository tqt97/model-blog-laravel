<?php

namespace Tqt97\ModelBlogLaravel\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface Category
{
    public function articles(): HasMany;
}
