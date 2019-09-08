<?php

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

// project root directory
define('WTS_ROOT', realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);

// config files directory
define('WTS_CONFIG', WTS_ROOT . 'config' . DIRECTORY_SEPARATOR);

// theme files directory
define('WTS_THEME_FILE_DIR', realpath(get_theme_file_path()) . DIRECTORY_SEPARATOR);

// routes directory
define('WTS_ROUTES_DIR', WTS_THEME_FILE_DIR . 'routes' . DIRECTORY_SEPARATOR);

// views directory
define('WTS_VIEWS_DIR', WTS_THEME_FILE_DIR . 'views' . DIRECTORY_SEPARATOR);

// view data directory
define('WTS_VIEW_DATA_DIR', WTS_THEME_FILE_DIR . 'data' . DIRECTORY_SEPARATOR);

// composer autoloader
require WTS_ROOT . 'vendor/autoload.php';

// register error handling for cool kids
(new Run)->prependHandler(new PrettyPageHandler)->register();

// load app files
array_map(function ($file) {
    $root = WTS_ROOT;
    require "{$root}app/{$file}.php";
}, ['bootstrap', 'helpers', 'remove_wp_bs', 'setup', 'filters', 'routes']);

// temporarily load script for quick debugging
include WTS_ROOT . 'tests/debug.php';
