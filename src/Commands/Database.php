<?php

namespace Elasticweb\Api\Commands;

use Elasticweb\Api\BaseCommand;

/**
 * Class Database.
 *
 * @package Elasticweb\Api\Command
 */
class Database extends BaseCommand {

  /**
   * @param int $node_id
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function getList($node_id) {
    return $this->getClient()->get('database/list/' . $node_id);
  }

  /**
   * @param int $node_id
   * @param array $params
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function postEntry($node_id, array $params = []) {
    return $this->getClient()->post('database/entry/' . $node_id, [
      'form_params' => $params,
    ]);
  }

  /**
   * @param int $node_id
   * @param string $db_name
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function deleteEntry($node_id, $db_name) {
    return $this->getClient()->delete(sprintf('database/entry/%d/%s', $node_id, $db_name));
  }

}