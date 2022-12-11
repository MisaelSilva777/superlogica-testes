<?php


/**
 * Render specific view
 *
 * @param string $view_name - name of view.
 * @return void
 */
function renderView( string $view_name ) : void {

    $file_path =  __DIR__ . "/views/$view_name.php";

    if ( ! file_exists( $file_path ) ) {

        return;

    }

    require_once $file_path;

}

/**
 * Check if has a empty field in the array data
 *
 * @param array $data - array with the field values
 * @return boolean
 */
function checkHasEmptyFields( array $data ) : bool {

    if ( ! in_array( '', $data) ) {

        return false;

    }

    return true;

}

/**
 * Check if the string is a email
 *
 * @param string $email - email string to test
 * @return boolean
 */
function stringIsEmail( string $email ) : bool {

    if( ! filter_var( $email, FILTER_VALIDATE_EMAIL) ) {

        return false;

    }

    return true;

}

/**
 * Check if the  string has only letters and numbers
 *
 * @param string $string - string to test
 * @return boolean
 */
function stringHasOnlyLettersAndNumbers( string $string ) : bool {

    return preg_match("/^[a-zA-Z0-9]+$/", $string); 

}


