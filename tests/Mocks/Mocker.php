<?php

namespace Elasticweb\Api\Tests\Mocks;

use Elasticweb\Api\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;

/**
 * Class Mocker.
 *
 * @package Elasticweb\Api\Tests\Mocks
 */
class Mocker {

  /**
   * This creates a raw api response to simulate what Elasticweb API replies
   * with.
   *
   * @param array $response
   * @param int $status
   *
   * @return Client
   */
  public static function apiResponse(array $response, $status = 200) {
    $response = array_merge(['status' => TRUE], $response);

    $body = json_encode($response);

    $mock = new MockHandler([
      new Response($status, [], $body),
    ]);

    $handler = HandlerStack::create($mock);
    $client = new \GuzzleHttp\Client(['handler' => $handler]);
    return new Client('token', $client);
  }

}
