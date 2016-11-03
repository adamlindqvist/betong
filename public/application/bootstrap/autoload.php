<?php defined('C5_EXECUTE') or die('Access Denied.');

/**
 * ----------------------------------------------------------------------------
 * Load all composer autoload items.
 * ----------------------------------------------------------------------------
 */

require_once(DIR_BASE . '/../vendor/autoload.php');

try {
    $dotenv = new \Dotenv\Dotenv(DIR_BASE . '/../');
    $dotenv->load();
} catch (Exception $e) {
    exit('Missing the environment configuration');
}

if (!@include(DIR_BASE_CORE . '/' . DIRNAME_VENDOR . '/autoload.php')) {
    die('Third party libraries not installed. Make sure that composer has required libraries in the concrete/ directory.');
}

