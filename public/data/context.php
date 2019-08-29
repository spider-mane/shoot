<?php

if (!isset($context)) {
    return;
}

/*
|--------------------------------------------------------------------------
| Context
|--------------------------------------------------------------------------
|
| When this  file is loaded, the context will be passed to it,
| allowing modification of default values.
|
*/
return [

    /*
    |--------------------------------------------------------------------------
    | Add
    |--------------------------------------------------------------------------
    |
    | Define items to add to default context
    |
    */
    'add' => [
        'header' => ['class' => ''],
        'body' => ['class' => $context['body_class']],
        'main' => ['class' => ''],
        'footer' => ['class' => ''],
        'navbar' => ['class' => ''],
        'icon' => '',
        'entity' => wts_get_data('entity')
    ],

    /*
    |--------------------------------------------------------------------------
    | Remove
    |--------------------------------------------------------------------------
    |
    | Define items to remove from default context
    |
    */
    'remove' => [
        'body_class'
    ]
];
