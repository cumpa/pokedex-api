<?php
/**
 * Created by PhpStorm.
 * User: Petr
 * Date: 26.1.2018
 * Time: 18:58
 */

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
    'db' => [
        'host' => 'localhost',
        'dbname' => 'pokedex-api',
        'username' => 'root',
        'password' => '',
        'driver' => 'mysql'
    ]
];

function getConf(){
    $config = [
        'settings' => [
            'displayErrorDetails' => true,
        ],
        'db' => [
            'host' => 'localhost',
            'dbname' => 'pokedex-api',
            'username' => 'root',
            'password' => '',
            'driver' => 'mysql'
        ]
    ];
    return $config;
}