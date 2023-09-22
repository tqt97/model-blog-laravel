<?php

namespace Tqt97\ModelBlogLaravel\Models;

use Tqt97\ModelBlogLaravel\Models\Category;
use Tqt97\ModelBlogLaravel\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tqt97\ModelBlogLaravel\Contracts\Article as ArticleContract;

class Article extends Model implements ArticleContract
{
    use HasFactory;

    protected $guarded = ['id'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
