<?php

namespace app\core;

/**
 * Class Response
 */
class Response
{
    public function redirect($url)
    {
        header("Location: $url");
    }
}