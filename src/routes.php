<?php

use Fcw\Controllers;

// Routes
$app->get('/', Controllers\DefaultController::class . ':index');
$app->get('/cadastro', Controllers\CadastroController::class . ':index');
$app->get('/logout', Controllers\LoginController::class . ':logout');
$app->get('/teste', Controllers\LoginController::class . ':teste');
$app->get('/login', Controllers\LoginController::class . ':index');
