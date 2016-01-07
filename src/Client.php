<?php

namespace Elasticweb\Api;

use Elasticweb\Api\Exceptions\ElasticwebSDKException;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Client.
 *
 * @property \Elasticweb\Api\Commands\User user
 * @property \Elasticweb\Api\Commands\Account account
 * @property \Elasticweb\Api\Commands\Server server
 * @property \Elasticweb\Api\Commands\Domain domain
 * @property \Elasticweb\Api\Commands\Dns dns
 * @property \Elasticweb\Api\Commands\Database database
 * @property \Elasticweb\Api\Commands\DatabaseUser database_user
 * @property \Elasticweb\Api\Commands\Billing billing
 *
 * @package Elasticweb\Api
 */
class Client {

  // API url.
  const BASE_URL = 'https://elasticweb.org/api/';
  /**
   * @var \GuzzleHttp\Client
   */
  protected $client;
  /**
   * @var \GuzzleHttp\Psr7\Response
   */
  protected $response;

  /**
   * Client constructor.
   *
   * @param mixed $token
   *   User token.
   * @param null|GuzzleHttpClient $http_client_handler
   *   (optional) Guzzle handler, use this param for phpunit.
   *
   * @throws \Elasticweb\Api\Exceptions\ElasticwebSDKException
   */
  public function __construct($token = FALSE, $http_client_handler = NULL) {
    if (!$token) {
      throw new ElasticwebSDKException('Token is required.');
    }

    $this->client = $http_client_handler ? $http_client_handler : new GuzzleHttpClient([
      'base_uri' => self::BASE_URL,
      'verify' => FALSE,
      'headers' => [
        'X-API-KEY' => $token,
      ],
    ]);
  }

  /**
   * Gets HTTP client for internal class use.
   *
   * @return \GuzzleHttp\Client
   */
  public function getClient() {
    return $this->client;
  }

  /**
   * Get headers last request.
   *
   * @return array
   */
  public function getHeadersLastRequest() {
    return $this->response->getHeaders();
  }

  /**
   * Get status code last request.
   *
   * @return int
   */
  public function getStatusCodeLastRequest() {
    return $this->response->getStatusCode();
  }

  /**
   * @param string $uri
   * @param array $options
   *
   * @return \Elasticweb\Api\BaseObject
   * @see \Elasticweb\Api\Client::send()
   * @throws \Elasticweb\Api\Exceptions\ElasticwebSDKException
   */
  public function get($uri, array $options = []) {
    return $this->send('GET', $uri, $options);
  }

  /**
   * @param string $uri
   * @param array $options
   *
   * @return \Elasticweb\Api\BaseObject
   * @see \Elasticweb\Api\Client::send()
   * @throws \Elasticweb\Api\Exceptions\ElasticwebSDKException
   */
  public function post($uri, array $options = []) {
    return $this->send('POST', $uri, $options);
  }

  /**
   * @param string $uri
   * @param array $options
   *
   * @return \Elasticweb\Api\BaseObject
   * @see \Elasticweb\Api\Client::send()
   * @throws \Elasticweb\Api\Exceptions\ElasticwebSDKException
   */
  public function patch($uri, array $options = []) {
    return $this->send('PATCH', $uri, $options);
  }

  /**
   * @param string $uri
   * @param array $options
   *
   * @return \Elasticweb\Api\BaseObject
   * @see \Elasticweb\Api\Client::send()
   * @throws \Elasticweb\Api\Exceptions\ElasticwebSDKException
   */
  public function delete($uri, array $options = []) {
    return $this->send('DELETE', $uri, $options);
  }

  /**
   * @param string $method
   * @param string $uri
   * @param array $options
   *
   * @return \Elasticweb\Api\BaseObject
   * @throws \Elasticweb\Api\Exceptions\ElasticwebSDKException
   */
  public function send($method = 'GET', $uri, array $options = []) {
    try {
      $response = $this->getClient()->request($method, $uri, $options);
    }
    catch (RequestException $e) {
      $response = $e->getResponse();

      if (!$response instanceof ResponseInterface) {
        throw new ElasticwebSDKException($e->getMessage(), $e->getCode());
      }
    }

    $this->response = $response;
    $body = $response->getBody()->getContents();
    $json = json_decode($body, TRUE);

    if (!$json) {
      throw new ElasticwebSDKException(sprintf('The request did not return a json: %s', $body));
    }

    return new BaseObject($json);
  }

  /**
   * @param string $name
   *
   * @return mixed
   */
  public function __get($name) {
    $name = camel_case($name);
    $command_class_name = '\\Elasticweb\\Api\\Commands\\' . ucfirst($name);

    if (class_exists($command_class_name)) {
      return new $command_class_name($this);
    }

    return NULL;
  }

}
