<?php

namespace Elasticweb\Api\Commands;

use Elasticweb\Api\BaseCommand;

/**
 * Class Account.
 *
 * @package Elasticweb\Api\Command
 */
class Account extends BaseCommand {

  /**
   * @return \Elasticweb\Api\BaseObject
   */
  public function getList() {
    return $this->getClient()->get('account/list');
  }

  /**
   * @param array $params
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function postEntry(array $params = []) {
    return $this->getClient()->post('account/entry', [
      'form_params' => $params,
    ]);
  }

  /**
   * @param int $node_id
   * @param array $params
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function patchEntry($node_id, array $params = []) {
    return $this->getClient()->patch('account/entry/' . $node_id, [
      'json' => $params,
    ]);
  }

  /**
   * @param int $node_id
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function deleteEntry($node_id) {
    return $this->getClient()->delete('account/entry/' . $node_id);
  }

  /**
   * @param int $node_id
   * @param string $tasks
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function patchCron($node_id, $tasks = '') {
    return $this->getClient()->patch('account/cron/' . $node_id, [
      'json' => ['tasks' => $tasks],
    ]);
  }

}