<?php
/*
 * Edith's dispatching controller.
 *
 * RESTfully answers to GET, HEAD, POST, PUT and DELETE to these resources:
 *   /{pagename}
 *   /{pagename}.{representation}
 */

@include 'config.php';
require 'lib/helpers.php';
require 'lib/page.class.php';
require 'lib/markdown_extended.php';

$REPRESENTATIONS = array('html', 'txt', 'remark', 'graphviz');

if (!defined('EDITH_URI'))
  define('EDITH_URI', '');

if (!defined('EDITH_DATA_PATH'))
  define('EDITH_DATA_PATH', 'data');

if (!defined('EDITH_DATA_EXTENSION'))
  define('EDITH_DATA_EXTENSION', '.txt');

if (!defined('URI_REGEX'))
  define('URI_REGEX', '#^/?([^/]+?)\.?('.implode('|', $REPRESENTATIONS).')?$#');

if (!defined('MOBWRITE_KEY'))
  define('MOBWRITE_KEY', 'edith');

if (!defined('MOBWRITE_URI'))
  define('MOBWRITE_URI', null);

// If no name is provided
if (preg_match('/\/$/', $_SERVER["REQUEST_URI"])) 
{
  // Generate a name with 4 random unambiguous characters. Redirect to it.
    header("Location: $base_url/" . substr(str_shuffle('234579abcdefghjkmnpqrstwxyz'), -4));
      die;
}

if (file_exists(preg_replace('#^\/#', '', $_SERVER["REQUEST_URI"])))
  return false;

require 'lib/routes.php';
