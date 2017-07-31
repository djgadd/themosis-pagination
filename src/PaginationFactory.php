<?php

namespace KeltieCochrane\Pagination;

use WP_Query;

class PaginationFactory
{
  /**
   * @var array
   */
  protected $defaultConfig;

  /**
   * Bleep bloop
   *
   * @return void
   */
  public function __construct ()
  {
    $this->parseDefaultConfig();
  }

  /**
   * Returns a new paginator for us to work with
   *
   * @param null|array $config
   * @param null|\WP_Query $query
   * @return \KeltieCochrane\Pagination\Pagination
   */
  public function make (array $config = null, WP_Query $query = null) : Pagination
  {
    return new Pagination($config, $query);
  }

  /**
   * Merges config with defaultConfig and sets some parameters that can't be changed
   *
   * @param null|array $config
   * @return array
   */
  public function parseConfig (array $config = null) : array
  {
    $config = array_merge($this->defaultConfig, $config ?: []);

    $config['type'] = 'array';

    return $config;
  }

  /**
   * Parses default config by merging internal defaults with params in the config
   * file.
   *
   * @return void
   */
  protected function parseDefaultConfig ()
  {
    $this->defaultConfig = array_merge([
      'base' => str_replace(PHP_INT_MAX, '%#%', get_pagenum_link(PHP_INT_MAX, true)),
      'format' => '/page/%#%',
      'end_size' => 3,
      'mid_size' => 3,
      'prev_text' => 'Previous',
      'next_text' => 'Next',
    ], app('config')->get('pagination', []));
  }
}
