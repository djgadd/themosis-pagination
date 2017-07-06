<?php

use Illuminate\Support\Collection;
use KeltieCochrane\Pagination\Pagination;

if (!function_exists('kc_pagination')) {
  /**
   * Helper method for pagination
   *
   * @param null|WP_Query $wp_query
   * @return \KeltieCochrane\Pagination\Pagination
   */
  function kc_pagination (array $args = null, WP_Query $query = null) : Pagination
  {
    return app('pagination')->make($args, $query);
  }
}
