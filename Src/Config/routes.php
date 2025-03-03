<?php

return [
    '~^articles/all$~' => [\Src\Controllers\ArticlesController::class,'all'],
    '~^articles/(\d+)$~' => [\Src\Controllers\ArticlesController::class,'view'],
    '~^articles/(\d+)/edit$~' => [\Src\Controllers\ArticlesController::class,'edit'],
    '~^articles/(\d+)/delete$~' => [\Src\Controllers\ArticlesController::class,'delete'],
    '~^articles/add$~' => [\Src\Controllers\ArticlesController::class,'add'],
    '~^users/register$~' => [\Src\Controllers\UsersController::class,'signUp'],
    '~^users/login$~' => [\Src\Controllers\UsersController::class,'login'],
    '~^users/logout$~' => [\Src\Controllers\UsersController::class,'logout'],
    '~^hello/(.*)$~' => [\Src\Controllers\MainController::class,'sayHello'],
    '~^$~' => [\Src\Controllers\MainController::class,'main'],
];