<?php

namespace Elasticweb\Api\Commands;

use Elasticweb\Api\BaseCommand;

/**
 * Class Dns.
 *
 * @package Elasticweb\Api\Command
 */
class Dns extends BaseCommand {

  /**
   * @param string $domain_name
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function getList($domain_name) {
    return $this->getClient()->get('dns/list/' . $domain_name);
  }

  /**
   * @param int $dns_id
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function getEntry($dns_id) {
    return $this->getClient()->get('dns/entry/' . $dns_id);
  }

  /**
   * @param string $domain_name
   * @param array $params
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function postEntry($domain_name, array $params = []) {
    return $this->getClient()->post('dns/entry/' . $domain_name, [
      'form_params' => $params,
    ]);
  }

  /**
   * @param int $dns_id
   *
   * @return \Elasticweb\Api\BaseObject
   */
  public function deleteEntry($dns_id) {
    return $this->getClient()->delete('dns/entry/' . $dns_id);
  }

}