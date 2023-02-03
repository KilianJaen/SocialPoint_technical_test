<?php

namespace KilianJaen\Ranking\ApiCalls;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class AbsoluteApiCallTest extends TestCase
{
    public function testApiCallTop100()
    {
        $http = new Client();
        $response = $http->request('GET', 'http://localhost:8080/ranking?type=Top100', ['http_errors' => false]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testApiCallTop200()
    {
        $http = new Client();
        $response = $http->request('GET', 'http://localhost:8080/ranking?type=Top200', ['http_errors' => false]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testApiCallTop500()
    {
        $http = new Client();
        $response = $http->request('GET', 'http://localhost:8080/ranking?type=Top500', ['http_errors' => false]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testApiCallWithErrors()
    {
        $http = new Client();
        $response = $http->request('GET', 'http://localhost:8080/ranking?type=Top0', ['http_errors' => false]);

        $this->assertEquals(404, $response->getStatusCode());
    }
}