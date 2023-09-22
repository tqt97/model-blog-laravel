<?php

namespace Tqt97\ModelBlogLaravel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tqt97\ModelBlogLaravel\Contracts\Tag as TagContract;

class Tag extends Model implements TagContract
{
    use HasFactory;

    protected $guarded = ['id'];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
