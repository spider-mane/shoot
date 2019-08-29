<?php

# api

/**
 * Google Reviews
 */
$google = wts_get_config('api.google.places');
$googleReviews = [];

# query string values
$url = $google['url'];
$key = $google['key'];
$placeId = $google['placeid'];

# uri
$uri = "{$url}?key={$key}&placeid={$placeId}&fields=reviews";

$google = json_decode(file_get_contents($uri), true);

if ('OK' == $google['status']) {
    /**
     * extract data to be anticipated by template
     */
    foreach ($google['result']['reviews'] as $review) {

        // sorry not sorry ¯\_(ツ)_/¯
        if (4 > $rating = (int) $review['rating']) {
            continue;
        }

        $testimonial = [
            'name' => $review['author_name'],
            'photo' => $review['profile_photo_url'],
            'rating' => $rating,
            'source' => 'google',
            'text' => $review['text'],
        ];

        $googleReviews[] = $testimonial;
    }
}

/**
 *
 */
return [
    'google' => $googleReviews
];
