<?php

namespace Elasticweb\Api;

/**
 * Class BaseCommand.
 *
 * @package Elasticweb\Api
 */
class BaseCommand {

  /**
   * @var Client
   */
  protected $client;

  /**
   * @param \Elasticweb\Api\Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @return \Elasticweb\Api\Client
   */
  protected function getClient() {
    return $this->client;
  }

}
