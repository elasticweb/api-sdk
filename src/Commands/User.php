<?php

namespace Elasticweb\Api\Commands;

use Elasticweb\Api\BaseCommand;

/**
 * Class User.
 *
 * @package Elasticweb\Api\Command
 */
class User extends BaseCommand {

  /**
   * @return \Elasticweb\Api\BaseObject
   */
  public function getMe() {
    return $this->getClient()->get('user/me');
  }

}
