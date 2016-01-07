<?php

namespace Elasticweb\Api\Tests;

use Elasticweb\Api\Client;
use Elasticweb\Api\BaseObject;
use Elasticweb\Api\Tests\Mocks\Mocker;

/**
 * Class ApiTest.
 *
 * @package Elasticweb\Api\Tests
 */
class ApiTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Client
   */
  protected $api;

  public function setUp() {
    $this->api = new Client('token');
  }

  /**
   * @test
   * @expectedException \Elasticweb\Api\Exceptions\ElasticwebSDKException
   */
  public function testThrowsExceptionWhenNoToken() {
    new Client();
  }

  /**
   * @test
   */
  public function testInvalidToken() {
    $error_string = 'Invalid API key.';

    $this->api = Mocker::apiResponse(
      [
        'status' => FALSE,
        'error' => $error_string,
      ]
    );

    $response = $this->api->user->getMe();

    $this->assertFalse($response->getStatus());
    $this->assertEquals($error_string, $response->getError());
  }

  /**
   * @test
   */
  public function testInvalidTokenStatus() {
    $this->api = Mocker::apiResponse(
      [
        'status' => FALSE,
        'error' => 'Invalid API key.',
      ], 403
    );

    $this->api->user->getMe();

    $this->assertEquals(403, $this->api->getStatusCodeLastRequest());
  }

  /**
   * @test
   */
  public function testUserGet() {
    $this->api = Mocker::apiResponse(
      [
        'status' => TRUE,
        'data' => [
          'id' => '1',
          'mail' => 'test@example.com',
          'first_name' => 'Test',
          'last_name' => 'Test',
          'phone' => '+15417543010',
          'balance' => '14.02',
        ],
      ]
    );

    $response = $this->api->user->getMe();

    $this->assertInstanceOf(BaseObject::class, $response);
    $this->assertTrue($response->getStatus());
    $this->assertEquals('Test', $response->getData()->getLastName());
  }

  /**
   * @test
   */
  public function testServerGetList() {
    $this->api = Mocker::apiResponse(
      [
        'data' => [
          [
            'server_id' => 3,
            'name' => "Yellow",
            'host' => "yellow.elastictech.org",
            'ip_address' => "176.31.116.184",
            'information' => "France. PHP 5.6 / MySQL (MariaDB 10)  | 2x Intel Xeon E5606",
          ],
          [
            'server_id' => 4,
            'name' => "Black",
            'host' => "black.elastictech.org",
            'ip_address' => "149.202.180.11",
            'information' => "France. PHP 5.6 / MySQL (MariaDB 10) | 2x E5-2687Wv3",
          ],
        ],
      ]
    );

    $response = $this->api->server->getList();

    $this->assertInstanceOf(BaseObject::class, $response);
    $this->assertEquals(2, $response->getData()->count());
    $this->assertEquals(3, $response->getMany('data')->first()->getServerId());
  }

  /**
   * @test
   */
  public function testApiPost() {
    $this->api = Mocker::apiResponse(
      [
        'status' => TRUE,
        'message' => 'Database created.',
        'data' => [
          'id' => '1000',
        ],
      ]
    );

    $response = $this->api->database->postEntry(1, [
      'name' => 'test',
    ]);

    $this->assertInstanceOf(BaseObject::class, $response);
    $this->assertTrue($response->getStatus());
    $this->assertEquals(1000, $response->getData()->getId());
  }

  /**
   * @test
   */
  public function testApiPatch() {
    $message = 'Database user updated.';

    $this->api = Mocker::apiResponse(
      [
        'status' => TRUE,
        'message' => $message,
      ]
    );

    $response = $this->api->database_user->patchEntry(1, 'main', [
      'password' => '123456',
      'databases' => [
        1000,
      ],
    ]);

    $this->assertInstanceOf(BaseObject::class, $response);
    $this->assertTrue($response->getStatus());
    $this->assertEquals($message, $response->getMessage());
  }

  /**
   * @test
   */
  public function testApiDelete() {
    $message = 'Database deleted.';

    $this->api = Mocker::apiResponse(
      [
        'status' => TRUE,
        'message' => $message,
      ]
    );

    $response = $this->api->database->deleteEntry(1, 'main');

    $this->assertInstanceOf(BaseObject::class, $response);
    $this->assertTrue($response->getStatus());
    $this->assertEquals($message, $response->getMessage());
  }

}
