<?php

namespace Tqt97\ModelBlogLaravel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tqt97\ModelBlogLaravel\Contracts\Category as CategoryContract;

class Category extends Model implements CategoryContract
{
    use HasFactory;

    protected $guarded = ['id'];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
