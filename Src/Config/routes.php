<?php

return [
    '~^articles/all$~' => [\Src\Controllers\ArticlesController::class,'all'],
    '~^articles/(\d+)$~' => [\Src\Controllers\ArticlesController::class,'view'],
    '~^articles/(\d+)/edit$~' => [\Src\Controllers\ArticlesController::class,'edit'],
    '~^articles/(\d+)/delete$~' => [\Src\Controllers\ArticlesController::class,'delete'],
    '~^articles/add$~' => [\Src\Controllers\ArticlesController::class,'add'],
    '~^products/all$~' => [\Src\Controllers\ProductsController::class,'all'],
    '~^products/(\d+)$~' => [\Src\Controllers\ProductsController::class,'view'],
    '~^products/(\d+)/edit$~' => [\Src\Controllers\ProductsController::class,'edit'],
    '~^products/(\d+)/delete$~' => [\Src\Controllers\ProductsController::class,'delete'],
    '~^products/add$~' => [\Src\Controllers\ProductsController::class,'add'],
    '~^categories/all$~' => [\Src\Controllers\CategoriesController::class,'all'],
    '~^categories/(\d+)$~' => [\Src\Controllers\CategoriesController::class,'view'],
    '~^categories/(\d+)/edit$~' => [\Src\Controllers\CategoriesController::class,'edit'],
    '~^categories/(\d+)/delete$~' => [\Src\Controllers\CategoriesController::class,'delete'],
    '~^categories/add$~' => [\Src\Controllers\CategoriesController::class,'add'],
    '~^users/register$~' => [\Src\Controllers\UsersController::class,'signUp'],
    '~^users/login$~' => [\Src\Controllers\UsersController::class,'login'],
    '~^users/logout$~' => [\Src\Controllers\UsersController::class,'logout'],
    '~^hello/(.*)$~' => [\Src\Controllers\MainController::class,'sayHello'],
    '~^$~' => [\Src\Controllers\MainController::class,'main'],
];