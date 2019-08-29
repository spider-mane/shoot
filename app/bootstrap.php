<?php

use WebTheory\Data;
use WebTheory\Config;
use WebTheory\Container;

/**
 * add config files to container
 */
Container::getInstance()->bindIf('config', function () {

    $config = WTS_CONFIG;

    foreach (scandir($config) as $uration) {
        $path = "{$config}/{$uration}";

        if (is_dir($path)) continue;

        $uration = pathinfo($path);

        if ('php' !== $uration['extension']) continue;

        $uration = $uration['filename'];

        $urations[$uration] = require "{$config}/{$uration}.php";
    }

    return new Config($urations);
}, true);

/**
 * add model data files to container
 */
Container::getInstance()->bindIf('data', function () {

    $files = WTS_VIEW_DATA_DIR;

    foreach (scandir($files) as $data) {
        $data = pathinfo("{$files}/{$data}");

        if ('php' !== $data['extension']) continue;

        $data = $data['filename'];

        $info[$data] = require "{$files}/{$data}.php";
    }

    return new Data($info);
}, true);
