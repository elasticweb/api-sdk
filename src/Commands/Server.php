<?php

namespace Elasticweb\Api\Commands;

use Elasticweb\Api\BaseCommand;

/**
 * Class Server.
 *
 * @package Elasticweb\Api\Command
 */
class Server extends BaseCommand {

  /**
   * @return \Elasticweb\Api\BaseObject
   */
  public function getList() {
    return $this->getClient()->get('server/list');
  }

}