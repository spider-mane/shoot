<?php

/**
 * redirects wordpress template loader to desired subdirectory
 */

$routes = [
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date',
    'embed', 'home', 'frontpage', 'page', 'paged', 'search', 'single',
    'singular', 'attachment',
];

foreach ($routes as $route) {

    add_filter("{$route}_template_hierarchy", function ($templates) {

        foreach ((array) $templates as $i => $template) {
            $templates[$i] = "routes/{$template}";
        }

        return $templates;
    }, PHP_INT_MAX);
}
