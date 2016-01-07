<?php

namespace Elasticweb\Api\Commands;

use Elasticweb\Api\BaseCommand;

/**
 * Class Domain.
 *
 * @package Elasticweb\Api\Command
 */
class Domain extends BaseCommand {

  /**
   * @param int $node_id
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function getList($node_id) {
    return $this->getClient()->get('domain/list/' . $node_id);
  }

  /**
   * @return \Elasticweb\Api\BaseObject
   */
  public function getNginxConfigurations() {
    return $this->getClient()->get('domain/nginx_configurations');
  }

  /**
   * @param int $node_id
   * @param array $params
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function postEntry($node_id, array $params = []) {
    return $this->getClient()->post('domain/entry/' . $node_id, [
      'form_params' => $params,
    ]);
  }

  /**
   * @param string $domain_name
   * @param array $params
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function patchEntry($domain_name, array $params = []) {
    return $this->getClient()->patch('domain/entry/' . $domain_name, [
      'json' => $params,
    ]);
  }

  /**
   * @param string $domain_name
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function deleteEntry($domain_name) {
    return $this->getClient()->delete('domain/entry/' . $domain_name);
  }

}