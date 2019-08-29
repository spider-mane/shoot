<?php

use joshtronic\LoremIpsum;

return [

    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    |
    | Specify filters to add to twig when loaded.
    |
    */
    'filters' => [
        'url' => 'home_url',
        'us_phone' => 'phone_format_us',
        'phone_link' => 'phone_link',
    ],

    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    |
    | Specify functions to add to twig when loaded.
    |
    */
    'functions' => [
        'class_append',
        'class_remove',
        'class_alter',

        'lorem_ipsum' => function ($count, $what = 'words', $tags = false) {
            $lorem = new LoremIpsum;

            return $lorem->$what($count, $tags, false);
        },

        'spaces' => function ($spaces) {
            $returnVal = '';

            for ($i = 1; $i <= $spaces; ++$i) {
                $returnVal .= '&nbsp;';
            }

            return $returnVal;
        }
    ]
];
