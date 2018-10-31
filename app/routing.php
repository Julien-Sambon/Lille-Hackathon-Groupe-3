<?php
/**
 * This file hold all routes definitions.
 *
 * PHP version 7
 *
 * @category Config
 * @package  Config
 * @author   WCS <contact@wildcodeschool.fr>
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

$routes = [
    'Default' => [ // Controller
        ['index', '/', ['GET', 'POST']], // action, url, method
        ['disconnect', '/disconnect', ['GET', 'POST']], // action, url, method
    ],
    'Child' => [ // Controller
        ['index', '/child', ['GET', 'POST']], // action, url, method
        ['inventory', '/child/inventory', ['GET', 'POST']], // action, url, method
        ['select', '/child/select/{id}', ['GET', 'POST']], // action, url, method
    ],
    'Mom' => [ // Controller
        ['index', '/mom', ['GET', 'POST']], // action, url, method
    ]
];
