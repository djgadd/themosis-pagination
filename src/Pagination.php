<?php

// TODO: sunra/php-simple-html-dom-parser from WordPress into package

namespace KeltieCochrane\Pagination;

use WP_Query;
use Countable;
use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use Illuminate\Support\Collection;
use Sunra\PhpSimple\HtmlDomParser;

class Pagination implements ArrayAccess, Countable, IteratorAggregate
{
  /**
   * @var array
   */
  protected $config;

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
   * @param null|array $config
   * @param null|\WP_Query $query
   * @global $wp_query
   * @return void
   */
  public function __construct (array $config = null, WP_Query $query = null)
  {
    global $wp_query;

    $this->config = app('pagination')->parseConfig($config);
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
    $items = collect(paginate_links($this->config));

    return $items->map(function ($item) {
      $el = HtmlDomParser::str_get_html($item)->firstChild();
      $class = array_key_exists('class', $el->attr) ? trim(str_replace('page-numbers', '', $el->attr['class'])) : '';
      $class = array_reduce(explode(' ', $class), function ($classes, $class) {
        if (!empty($class)) {
          $classes .= sprintf('is-%s', $class);
        }

        return $classes;
      }, '');

      return [
        'url' => array_key_exists('href', $el->attr) ? $el->attr['href'] : false,
        'class' => $class,
        'text' => trim($el->innertext()),
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

  /**
   * Check if offset exists in items
   *
   * @return bool
   */
  public function offsetExists ($offset) : bool
  {
    return $this->items->offsetExists($offset);
  }

  /**
   * Returns an offset from items
   *
   * @return mixed
   */
  public function offsetGet ($offset)
  {
    return $this->items->offsetGet($offset);
  }

  /**
   * Sets an offset value in items
   *
   * @return void
   */
  public function offsetSet ($offset, $value)
  {
    $this->items->offsetSet($offset, $value);
  }

  /**
   * Unsets an offset value in items
   *
   * @return void
   */
  public function offsetUnset ($offset)
  {
    $this->items->offsetUnset($offset);
  }

  /**
   * Return the number of items
   *
   * @return int
   */
  public function count () : int
  {
    return $this->items->count();
  }

  /**
   * Get an iterator for the items.
   *
   * @return \ArrayIterator
   */
  public function getIterator () : ArrayIterator
  {
    return $this->items->getIterator();
  }
}
