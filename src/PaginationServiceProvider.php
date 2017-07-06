<?php

namespace KeltieCochrane\Pagination;

use Themosis\Foundation\ServiceProvider;

class PaginationServiceProvider extends ServiceProvider
{
  /**
   * Defer loading unless we need it, saves us a little bit of overhead if the
   * current request isn't trying to log anything.
   *
   * @var bool
   */
  protected $defer = true;

  /**
   * Register bindings in the container.
   * @return void
  **/
  public function register ()
  {
    $this->app->singleton('pagination', function ($app) {
      return new PaginationManager($app);
    });
  }
}
