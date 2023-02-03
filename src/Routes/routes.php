<?php

use \KilianJaen\Ranking\Controllers\RankingsController;
use \KilianJaen\Ranking\Controllers\RoutesController;
use \KilianJaen\Ranking\Controllers\UsersController;

$routesController = new RoutesController();

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = array_filter($url);

if (empty($url)) {
    echo $routesController->routeNotFoundMessage();;
    return;
}

if (count($url) > 0 && isset($_SERVER['REQUEST_METHOD'])) {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            $url = explode("?", current($url));
            if (strtolower(current($url)) == 'ranking') {
                $rankingController = new RankingsController();
                $response = $rankingController->getAction($_GET);
                echo json_encode($response, http_response_code($response['status']));
                return;
            }
            break;
        case 'POST':
            $params = json_decode(file_get_contents('php://input'), true);
            if (strtolower(current($url)) == "user") {
                if (count($url) === 3 && strtolower($url[3]) === "score") {
                    if (isset($params['total']) && isset($params['score'])) {
                        $response = ['status' => 404, 'result' => 'Invalid Params, send params score or total'];
                        echo json_encode($response, http_response_code($response['status']));
                        return;
                    }
                    $userId = !empty($url[2]) ? $url[2] : null;
                    $isScore = isset($params['score']);
                    $isTotal = isset($params['total']);

                    $userController = new UsersController();
                    $response = $userController->getAction($userId, $params, $isScore, $isTotal);
                    echo json_encode($response, http_response_code($response['status']));
                    return;
                }
            }
            break;
        default:
            echo $routesController->routeNotFoundMessage();
            return;
    }
}
echo $routesController->routeNotFoundMessage();
return;