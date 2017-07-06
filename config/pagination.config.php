<?php

return [
  /*
  |--------------------------------------------------------------------------
  | Pagination URL Format
  |--------------------------------------------------------------------------
  |
  | Used for Pagination structure. The default value is '?page=%#%', If using
  | pretty permalinks this would be '/page/%#%', where the '%#%' is replaced by
  | the page number.
  |
  */
  'format' => '/page/%#%',

  /*
  |--------------------------------------------------------------------------
  | List Edge Padding Size
  |--------------------------------------------------------------------------
  |
  | How many numbers on either the start and the end list edges.
  |
  */
  'end_size' => 3,

  /*
  |--------------------------------------------------------------------------
  | List Middle Padding Size
  |--------------------------------------------------------------------------
  |
  | How many numbers to either side of current page, but not including current page.
  |
  */
  'mid_size' => 1,

  /*
  |--------------------------------------------------------------------------
  | Include previous/next links
  |--------------------------------------------------------------------------
  |
  | Whether to include the previous and next links in the list or not.
  |
  */
  'prev_next' => true,

  /*
  |--------------------------------------------------------------------------
  | Previous link text
  |--------------------------------------------------------------------------
  |
  | The previous page text. Works only if 'prev_next' argument is set to true.
  |
  */
  'prev_text' => 'Previous',

  /*
  |--------------------------------------------------------------------------
  | Next link text
  |--------------------------------------------------------------------------
  |
  | The next page text. Works only if 'prev_next' argument is set to true.
  |
  */
  'next_text' => 'Next',
];
