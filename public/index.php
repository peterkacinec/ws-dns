<?php

require_once('../core/Application.php');
require_once('../core/Request.php');
require_once('../core/Response.php');
require_once('../core/Router.php');
require_once('../core/View.php');
require_once('../core/Session.php');
require_once('../config.php');

use app\core\Application;
use app\controllers\SiteController;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'index']);
$app->router->get('/create', [SiteController::class, 'create']);
$app->router->post('/create', [SiteController::class, 'store']);
$app->router->get('/edit', [SiteController::class, 'edit']);
$app->router->post('/update', [SiteController::class, 'update']);
$app->router->post('/delete', [SiteController::class, 'destroy']);

$app->run();