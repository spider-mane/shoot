<?php

// namespace WebTheory;

use WebTheory\Container;
use WebTheory\PhoneHelper;

/**
 * Get the container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param Container $container
 * @return Container|mixed
 */
function wts_theme($make = null, $parameters = [], Container $container = null)
{
    $container = $container ?: Container::getInstance();

    if (!$make) {
        return $container;
    }

    return $container->make($make, $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\WebTheory\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function wts_get_config($key = null, $default = null)
{
    if (is_null($key)) {
        return wts_theme('config');
    }

    if (is_array($key)) {
        return wts_theme('config')->set($key);
    }

    return wts_theme('config')->get($key, $default);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\WebTheory\Data
 */
function wts_get_data($key = null, $default = null)
{
    if (is_null($key)) {
        return wts_theme('data');
    }

    if (is_array($key)) {
        return wts_theme('data')->set($key);
    }

    return wts_theme('data')->get($key, $default);
}

/**
 * wts_get_file
 *
 * @param string $file file to load default extension is .php
 * @param bool $php whether or not the file has php as an extension
 */
function wts_get_file(string $directory, bool $php = true)
{
    $php = (true === $php) ? '.php' : '';

    return realpath(WTS_ROOT . $directory . $php);
}

/**
 *
 */
function wts_social(...$platforms)
{
    $accounts = wts_get_data('social-media.accounts');

    if ($platforms) {
        $context = [];

        foreach ($platforms as $platform) {
            $context[$platform] = $accounts[$platform];
        }

        $accounts = $context;
    }

    return $accounts;
}

/**
 *
 */
function wts_social_context($context)
{
    $context = wts_get_data("social-media.contexts.{$context}");

    return wts_social(...$context);
}

/**
 *
 */
function phone_format_us(string $phoneNumber, string $format = '-')
{
    return wts_theme('phone')->formatUsNumber($phoneNumber, $format);
}

/**
 *
 */
function phone_link($phoneNumber, $region = 'US')
{
    return (new PhoneHelper)->getPhoneLink($phoneNumber, $region);
}
