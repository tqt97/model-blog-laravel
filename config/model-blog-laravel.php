<?php

// config for Tqt97/ModelBlogLaravel
return [
    /*
        *  List tables in your package
        *  you can change table name in this config if you want
        */
    'table_names' => [
        'articles' => 'articles',
        'categories' => 'categories',
        'tags' => 'tags',
        'pivot' => 'article_tag',
    ],

    'models' => [
        'article' => 'article',
        'category' => 'category',
        'tag' => 'tag',
    ],

];
