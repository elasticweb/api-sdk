<?php

namespace Elasticweb\Api\Commands;

use Elasticweb\Api\BaseCommand;

/**
 * Class DatabaseUser.
 *
 * @package Elasticweb\Api\Command
 */
class DatabaseUser extends BaseCommand {

  /**
   * @param int $node_id
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function getList($node_id) {
    return $this->getClient()->get('database_user/list/' . $node_id);
  }

  /**
   * @param int $node_id
   * @param string $db_user_name
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function getEntry($node_id, $db_user_name) {
    return $this->getClient()->get(sprintf('database_user/entry/%d/%s', $node_id, $db_user_name));
  }

  /**
   * @param int $node_id
   * @param array $params
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function postEntry($node_id, array $params = []) {
    return $this->getClient()->post('database_user/entry/' . $node_id, [
      'form_params' => $params,
    ]);
  }

  /**
   * @param int $node_id
   * @param string $db_user_name
   * @param array $params
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function patchEntry($node_id, $db_user_name, array $params = []) {
    return $this->getClient()->patch(sprintf('database_user/entry/%d/%s', $node_id, $db_user_name), [
      'json' => $params,
    ]);
  }

  /**
   * @param int $node_id
   * @param string $db_user_name
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function deleteEntry($node_id, $db_user_name) {
    return $this->getClient()->delete(sprintf('database_user/entry/%d/%s', $node_id, $db_user_name));
  }

}