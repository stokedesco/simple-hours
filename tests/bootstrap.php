<?php
$_tests_dir = getenv('WP_TESTS_DIR');
if (!$_tests_dir) {
    echo "Please set WP_TESTS_DIR environment variable.\n";
    exit(1);
}
require_once $_tests_dir . '/includes/functions.php';
function _manually_load_plugin() {
    require dirname(__DIR__) . '/simple-hours.php';
}
tests_add_filter('muplugins_loaded', '_manually_load_plugin');
require $_tests_dir . '/includes/bootstrap.php';