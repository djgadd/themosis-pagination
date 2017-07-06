<?php

namespace KeltieCochrane\Pagination;

use WP_Query;

class PaginationFactory
{
  /**
   * @var array
   */
  protected $defaultArgs;

  /**
   * Bleep bloop
   *
   * @return void
   */
  public function __construct ()
  {
    $this->parseDefaultArgs();
  }

  /**
   * Returns a new paginator for us to work with
   *
   * @param null|array $args
   * @param null|\WP_Query $query
   * @return \KeltieCochrane\Pagination\Pagination
   */
  public function make (array $args = null, WP_Query $query = null) : Pagination
  {
    return new Pagination($this->defaultArgs, $args, $query);
  }
}
