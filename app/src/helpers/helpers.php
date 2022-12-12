<?php


/**
 * Render specific view
 *
 * @param string $view_name - name of view.
 * @return void
 */
function renderView( string $view_name ) : void {

    $file_path =  __DIR__ . "/../assets/views/$view_name.php";

    if ( ! file_exists( $file_path ) ) {

        return;

    }

    require_once $file_path;

}

/**
 * Render specific script
 *
 * @param string $script_name - name of script.
 * @return void
 */
function renderScript( string $script_name ) : void {

    $file_path =  __DIR__ . "/../assets/scripts/$script_name.js";

    if ( ! file_exists( $file_path ) ) {

        return;

    }

    require_once $file_path;

}
