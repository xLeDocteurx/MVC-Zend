<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=rentmovies; host=den1.mysql2.gear.host',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
        'username' => 'rentmovies',
        'password' => 'Gn2oZ4~1GCv?',
    ],
];

// return [
//     'db' => [
//         'driver' => 'Pdo',
//         'dsn' => 'mysql:dbname=rentmovies; host=localhost',
//         'driver_options' => array(
//             PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
//         ),
//         'username' => 'root',
//         'password' => '314100ab',
//     ],
// ];