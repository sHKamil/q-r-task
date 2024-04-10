<?php

use App\Controllers\WelcomeController;

$router->get('/', WelcomeController::class, 'index');
