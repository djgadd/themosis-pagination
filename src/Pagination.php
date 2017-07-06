<?php

namespace KeltieCochrane\Pagination;

use WP_Query;
use Countable;
use ArrayAccess;
use DOMDocument;
use Illuminate\Support\Collection;

class Pagination implements ArrayAccess, Countable
{
  /**
   * @var array
   */
  protected $args;

  /**
   * @var \WP_Query
   */
  protected $query;

  /**
   * @var \Illuminate\Support\Collection
   */
  protected $items;

  /**
   * Bleep bloop
   *
   * @global $wp_query
   * @return void
   */
  public function __construct (array $defaultArgs, array $args = null, WP_Query $query = null)
  {
    global $wp_query;

    $this->args = array_merge($defaultArgs, $args ?: []);
    $this->query = $query ?: $wp_query;
    $this->items = $this->init();
  }

  /**
   * Builds up the paginated items and returns a collection of them
   *
   * @return \Illuminate\Support\Collection
   */
  protected function init () : Collection
  {
    $items = paginate_links($config);
    $doc = new DOMDocument;

    return $items->map(function ($item) use ($doc) {
      $el = $doc->loadHtml($item)->documentElement;

      return [
        'url' => $el->getAttribute('href') ?: false,
        'class' => trim(str_replace('page-numbers', '', $el->getAttribute('class'))),
        'text' => $el->nodeValue,
      ];
    });
  }

  /**
   * Returns the items collection, if it hasn't been instantiated calls ::init()
   *
   * @return \Illuminate\Support\Collection
   */
  public function getItems () : Collection
  {
    return $this->items;
  }

  /**
   * Map calls to the collection of items
   *
   * @param string $method
   * @param array $args
   * @return mixed
   */
  public function __call (string $method, array $args)
  {
    return call_user_func_array([$this->getItems(), $method], $args);
  }
}
