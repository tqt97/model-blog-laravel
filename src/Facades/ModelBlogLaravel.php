<?php

namespace Tqt97\ModelBlogLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tqt97\ModelBlogLaravel\ModelBlogLaravel
 */
class ModelBlogLaravel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Tqt97\ModelBlogLaravel\ModelBlogLaravel::class;
    }
}
