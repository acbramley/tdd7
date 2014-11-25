<?php

namespace oua\lms\testframework;

use PHPUnit_Framework_TestCase;
use ReflectionClass;

if (!defined('DRUPAL_ROOT')) {
  define('DRUPAL_ROOT', getcwd());
  require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
  drupal_override_server_variables();
  drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
}
if (!defined('PRODUCTLINE_CONSTRAINED_TESTS') && !getenv("PRODUCTLINE_CONSTRAINED_TESTS")) {
  define('PRODUCTLINE_CONSTRAINED_TESTS', FALSE);
}
else {
  define('PRODUCTLINE_CONSTRAINED_TESTS', TRUE);
}

/**
 * Class BasicTestCase
 * @package oua\lms\testframework
 */
abstract class BasicTestCase extends PHPUnit_Framework_TestCase {

  /**
   * Wrapper to handle the php53 nightmare.
   *
   * @param object|array $obj
   *   The object to jsonify.
   *
   * @return string
   *   The json string result.
   */
  protected static function safeJson($obj) {
    if (defined("JSON_PRETTY_PRINT")) {
      return json_encode($obj, JSON_PRETTY_PRINT);
    }
    return json_encode($obj);
  }

  /**
   * Constructor.
   *
   * Interrogates the test fixture to make sure the test
   * is supposed to run for the given product line.
   */
  public function setUp() {
    if (PRODUCTLINE_CONSTRAINED_TESTS) {
      $product_line = getenv("oua_productline");
      $me = new ReflectionClass($this);
      $comments = explode("\n", $me->getDocComment());
      $product_line_constrained = preg_grep("/@oua_productline/", $comments);

      if (!empty($product_line_constrained)) {
        $product_line_tags = array_values($product_line_constrained);
        $product_line_tag = $product_line_tags[0];
        $product_lines_list = preg_split("/^.*@oua_productline\\s/", $product_line_tag, -1, PREG_SPLIT_NO_EMPTY);
        $product_lines_filter = trim($product_lines_list[0]);
        $allowed_product_lines = explode(" ", $product_lines_filter);
        if (!in_array($product_line, $allowed_product_lines)) {
          self::markTestSkipped();
        }
      }
    }
  }

}