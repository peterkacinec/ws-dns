<?php

namespace app\core;

/**
 * Class Controller
 */
class Controller
{
    public string $layout = 'main';

    public function render($view, $params = []): string
    {
        return Application::$app->router->renderView($view, $params);
    }
}