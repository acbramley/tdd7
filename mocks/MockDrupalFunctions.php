<?php
/**
 * @file
 * Mocked up Drupal core functions
 * @author Edward Murrell <edward@catalyst-au.net>
 */

namespace oua\lms\testframework\mocks;

/**
 * Mock version of variable_set()
 * Original documentation: https://api.drupal.org/api/drupal/includes!bootstrap.inc/function/variable_set/7
 * @param string $name: The name of the variable to set.
 * @param string $value: The value to set. This can be any PHP data type; these
 *  functions take care of serialization as necessary.
 */
function variable_set($name, $value) {
}

/**
 * Mock version of variable_set()
 * Original documentation: https://api.drupal.org/api/drupal/includes!bootstrap.inc/function/variable_get/7
 * @param string $name: The name of the variable to return.
 * @param string $default: The default value to use if this variable has never
 *  been set.
 */
function variable_get($name, $default = NULL) {
}
