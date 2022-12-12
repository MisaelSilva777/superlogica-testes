<?php

namespace App\Services;

use App\Repositories\UserRepository;

/**
 * Validator class to helper User Service
 */
class UserValidator {

   /**
     * Check if has a empty field in the array data
     *
     * @param array $data - array with the field values
     * @return boolean
     */
    static function checkHasEmptyFields( array $data ) : bool {

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
    static function stringIsEmail( string $email ) : bool {

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
    static function stringHasOnlyLettersAndNumbers( string $string ) : bool {

        return preg_match("/^[a-zA-Z0-9]+$/", $string); 

    }

    /**
     * Check if the string has min 8 characters, one letter and one number
     *
     * @param string $password - password to validate
     * @return boolean
     */
    static function validatePassword( string $password ) : bool {

        return preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-zA-Z]).*$/", $password ); 

    }

    /**
     * Check if the username already exists
     *
     * @param string $username - username to validate
     * @return boolean
     */
    static function checkIfUserExists( string $username, UserRepository $userRepository ) : bool {

        return $userRepository->checkUserExists( $username ); 

    }

    /**
     * Check if the username already exists
     *
     * @param string $username - username to validate
     * @return boolean
     */
    static function checkIfEmailExists( string $email, UserRepository $userRepository ) : bool {

        return $userRepository->checkIfEmailExists( $email ); 

    }



}