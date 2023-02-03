<?php

namespace KilianJaen\Ranking\ApiCalls;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class RelativeApiCallTest extends TestCase
{
    public function testApiCallAt100_3()
    {
        $http = new Client();
        $response = $http->request('GET', 'http://localhost:8080/ranking?type=at100/3', ['http_errors' => false]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testApiCallAt10_3()
    {
        $http = new Client();
        $response = $http->request('GET', 'http://localhost:8080/ranking?type=at10/3', ['http_errors' => false]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testApiCallWithErrors()
    {
        $http = new Client();
        $response = $http->request('GET', 'http://localhost:8080/ranking?type=at1000/3', ['http_errors' => false]);

        $this->assertEquals(404, $response->getStatusCode());
    }
}