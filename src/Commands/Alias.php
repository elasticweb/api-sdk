<?php

namespace Elasticweb\Api\Commands;

use Elasticweb\Api\BaseCommand;

/**
 * Class Alias.
 *
 * @package Elasticweb\Api\Command
 */
class Alias extends BaseCommand {

  /**
   * @param int $node_id
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function getList($node_id) {
    return $this->getClient()->get('alias/list/' . $node_id);
  }

  /**
   * @param int $node_id
   * @param array $params
   *  - name
   *  - parent_domain
   *  - mx_records
   *  - error_log
   *  - access_log
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function postEntry($node_id, array $params = []) {
    return $this->getClient()->post('alias/entry/' . $node_id, [
      'form_params' => $params,
    ]);
  }

  /**
   * @param string $alias_name
   * @param array $params
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function patchEntry($alias_name, array $params = []) {
    return $this->getClient()->patch('alias/entry/' . $alias_name, [
      'json' => $params,
    ]);
  }

  /**
   * @param string $alias_name
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function deleteEntry($alias_name) {
    return $this->getClient()->delete('alias/entry/' . $alias_name);
  }

}