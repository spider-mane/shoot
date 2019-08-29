<?php

/**
 *
 */

use Timber\FunctionWrapper;

add_filter('timber/twig', function ($twig) {

    $extra = wts_get_config('twig');

    // functions
    foreach ($extra['functions'] as $alias => $original) {

        $alias = (is_string($alias)) ? $alias : $original;

        $twig->addFunction(new Twig_Function($alias, $original));
    }

    // filters
    foreach ($extra['filters'] as $filter => $function) {

        $filter = (is_string($filter)) ? $filter : $function;

        $twig->addFilter(new Twig_Filter($filter, $function));
    }

    return $twig;
});

/**
 *
 */
add_filter('timber/context', function ($context) {

    $config = include WTS_VIEW_DATA_DIR . 'context.php';

    $context = $config['add'] + $context;

    foreach ($config['remove'] as $thing) {
        unset($context[$thing]);
    }

    return $context;
});
