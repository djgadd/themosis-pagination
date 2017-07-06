# Themosis Pagination
A package for the Themosis framework that implements some basic utilities for pagination to make it a little easier to work with (rather than being bound by WordPresses markup and classes.)

## Install
Install through composer: -
`composer require keltiecochrane/themosis-pagination`

Copy the `config/pagination.config.php` to your `theme/resources/config` directory, and configure as appropriate.

Register the service provider in your `theme/resources/config/providers.php` file: -
`KeltieCochrane\Pagination\PaginationServiceProvider::class,`

## Examples
```
  /**
   * Helper function that maps to app('pagination')->make($args, $query)
   *
   * @param  null|array $args        optional args, see codex paginate_links function reference
   * @param  null|\WP_Query $query   optional query, by default will use global $wp_query
   * @return \Illuminate\Support\Collection
   */
  kc_pagination($args, $query = null);

  [
    [
      'url' => string|false,
      'class' => string,
      'text' => string,
    ],
    [...]
  ]
```

## Support
This package is provided as is, though we'll endeavour to help where we can.

## Contributing
Any contributions would be encouraged and much appreciated, you can contribute by: -

* Reporting bugs
* Suggesting features
* Sending pull requests
