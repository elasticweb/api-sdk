<?php

namespace Elasticweb\Api\Commands;

use Elasticweb\Api\BaseCommand;

/**
 * Class Billing.
 *
 * @package Elasticweb\Api\Command
 */
class Billing extends BaseCommand {

  /**
   * @return \Elasticweb\Api\BaseObject
   */
  public function getOperationTypes() {
    return $this->getClient()->get('billing/operation_types');
  }

  /**
   * @param string $type_name
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function getOperationsByTypeName($type_name) {
    return $this->getClient()->get('billing/operations/' . $type_name);
  }

}