<?php

use Symfony\Component\Dotenv\Dotenv;

/**
 * Function to define environment variables
 *
 * @return void
 */
function defineEnvVars(): void {

    $dotenv = new Dotenv();
    $dotenv->load(__DIR__.'/../../.env');

    if ( ! defined( 'PATH_API' ) ) define( 'PATH_API', $_ENV['PATH_API'] ?? "index.php") ;
    if ( ! defined( 'DB_HOST' ) ) define( 'DB_HOST', $_ENV['DB_HOST'] ?? "localhost") ;
    if ( ! defined( 'DB_USER' ) ) define( 'DB_USER', $_ENV['DB_USER'] ?? "root");
    if ( ! defined( 'DB_PASS' ) ) define( 'DB_PASS', $_ENV['DB_PASS'] ?? "");
    if ( ! defined( 'DB_DTBS' ) ) define( 'DB_DTBS', $_ENV['DB_DTBS'] ?? "user");

}