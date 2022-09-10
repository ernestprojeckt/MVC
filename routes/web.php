<?php
/**
 * @var $router Core\Router
 */
$router->add('admin/posts/{id:\d+}/edit',
    [
        'controller' => \App\Controllers\PostController::class,
        'action' => 'index',
        'method' => 'GET'
    ]
);

$router->add('posts/{id:\d+}',
    [
        'controller' => \App\Controllers\PostController::class,
        'action' => 'show',
        'method' => 'GET'
    ]
);
