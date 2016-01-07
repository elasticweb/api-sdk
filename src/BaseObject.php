<?php

namespace Elasticweb\Api;

use Illuminate\Support\Collection;

/**
 * Class BaseObject.
 */
class BaseObject extends Collection {

  /**
   * Get an item from the collection by key.
   *
   * @param mixed $key
   * @param mixed $default
   *
   * @return mixed
   */
  public function get($key, $default = NULL) {
    if ($this->offsetExists($key)) {
      return is_array($this->items[$key]) ? new static($this->items[$key]) : $this->items[$key];
    }

    return value($default);
  }

  /**
   * Get an item from the collection by key
   * and apply collection for each element of array.
   *
   * @param mixed $key
   * @param mixed $default
   *
   * @return mixed
   */
  public function getMany($key, $default = NULL) {
    if ($this->offsetExists($key)) {
      $result = new Collection();

      foreach ($this->items[$key] as $item) {
        $result->push(new static($item));
      }

      return $result;
    }

    return value($default);
  }

  /**
   * Magic method to get properties dynamically.
   *
   * @param $name
   * @param $arguments
   *
   * @return mixed
   */
  public function __call($name, $arguments) {
    $action = substr($name, 0, 3);

    if ($action === 'get') {
      $property = snake_case(substr($name, 3));
      $response = $this->get($property);
      return $response;
    }

    return FALSE;
  }

}
