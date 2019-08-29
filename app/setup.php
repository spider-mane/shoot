<?php

/**
 * Enqueue scripts and stylesheets
 */
add_action('wp_enqueue_scripts', function () {

    if (is_admin()) return;

    /**
     * asset locations
     */
    $assets = 'assets/dist/';
    $styles = $assets . 'styles/';
    $scripts = $assets . 'scripts/';

    /**
     * versions
     */
    $jqueryVer = '3.3.1';
    $bootstrapVer = '4.3.1';
    $fontAwesomeVer = '5.9.0';

    /**
     * get post for conditional loading
     */
    $post = get_post();

    wp_dequeue_style('wp-block-library');

    /**
     * jquery
     */
    wp_dequeue_script('jquery'); // remove built in, outdated jquery

    /**
     * font-awesome
     */
    wp_enqueue_style('font-awesome-cdn', "//use.fontawesome.com/releases/v{$fontAwesomeVer}/css/all.css", null, $fontAwesomeVer);

    /**
     * google maps
     */
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyC-PMj5P8atDt61zPmdlCeTkVv4KaW-CiU&callback=initMap', null, null, true);

    /**
     * project styles
     */
    wp_enqueue_style('webtheory/css--main', get_theme_file_uri($styles . 'styles.css'), null, time(), null);

    /**
     * project scripts
     */
    wp_enqueue_script('webtheory/js--main', get_theme_file_uri($scripts . 'script.js'), null, time(), true);
});

/**
 * Add theme supports
 */
add_action('after_theme_setup', function () {

    /**
     *
     */
    load_theme_textdomain('webtheory');

    /**
     *
     */
    add_theme_support('title-tag');

    /**
     *
     */
    add_theme_support('custom-logo');

    /**
     *
     */
    add_theme_support('post-thumbnails');

    /**
     *
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);
});

/**
 * Modify queries
 */
add_action('pre_get_posts', function ($query) {

    /**
     *
     */
    if (!is_admin() && is_post_type_archive('') && $query->is_main_query()) {
        $query->set('posts_per_page', -1);
    }
});
