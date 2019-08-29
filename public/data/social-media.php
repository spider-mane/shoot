<?php

/**
 * slug portions of social media account urls
 */
$facebook = '';
$instagram = '';
$twitter = '';
$linkedin = '';

/**
 *
 */
return [

    /**
     * Simple slug as key with value as array of values anticipated by
     * templates. Likely universals are a stylized name, url and icon.  The
     * nature of icon configuration will mostly depend on the api's of icon
     * libraries used.
     */
    'accounts' => [
        'facebook' => [
            'name' => 'Facebook',
            'url' => "https://facebook.com/{$facebook}",
            'icon' => 'fa-facebook-square',
        ],
        'instagram' => [
            'name' => 'Instagram',
            'url' => "https://instagram.com/{$instagram}",
            'icon' => 'fa-instagram',
        ],
        'twitter' => [
            'name' => 'Twitter',
            'url' => "https://twitter.com/{$twitter}",
            'icon' => 'fa-twitter',
        ],
        'linkedin' => [
            'name' => 'LinkedIn',
            'url' => "https://linkedin.com/company/{$linkedin}",
            'icon' => 'fa-linkedin-in'
        ]
    ],

    /**
     * For any context that will show a limited number of social media links,
     * specify the desired platforms by slug (key) for that context here.
     *
     * The default behavior is to render all social media platforms, but setting
     * a context value can also be used to customize the output order.
     */
    'contexts' => [
        'navbar' => ['facebook', 'instagram', 'twitter'],
        'footer' => ['linkedin', 'facebook', 'instagram', 'twitter'],
    ]
];
