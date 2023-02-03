<?php

namespace KilianJaen\Ranking\Controllers;

class RoutesController
{
    public function index()
    {
        include dirname(__FILE__) . "/../Routes/routes.php";
    }

    public function routeNotFoundMessage(): string
    {
        $response = ['status' => 404, 'result' => 'Not Found'];
        return json_encode($response, http_response_code($response['status']));
    }
}