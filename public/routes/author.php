<?php

use Timber\Timber;

/**
 * Get context
 */
$context = Timber::context();

/**
 * Do things
 */

/**
 * Load template
 */
Timber::render('pages/author.twig', $context);