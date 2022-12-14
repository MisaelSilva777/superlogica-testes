<?php

namespace App\controllers\Api;

use App\interfaces\UserApiInterface;
use App\Services\UserService;

class UserController implements UserApiInterface {

    protected $userService;

    /**
     * Constructor of UserController
     * Addd User service to attribute userService
     *
     * @param UserService $userService - User Service Class
     */
    public function __construct( UserService $userService ) {
        $this->userService = $userService;
    }


    /**
     * Method to return all users.
     *
     * @return void
     */
    public function index() : void {

        $users = $this->userService->getAllUsers();
        $this->httpResponde( 200, $users );

    }

    /**
     * Method to create a new user.
     *
	 * @param array $data - data of new element
     * @return void
     */
    public function create( array $data ) : void {

        $user = $this->userService->makeUser( $data);

        if ( ! empty( $user['error'] ) ) {
            $this->httpResponde( 200, $user );
        }

        $this->httpResponde( 200, $user );

    }

    /**
     * Method to return http response of route.
     *
     * @param string $status - status of http response.
     * @param mixed  $data   - content of response.
     * @return void
     */
    protected function httpResponde( string $status, array $data ) : void {

        http_response_code($status);
        echo json_encode([
            'status'                 => $status,
            array_key_first($data)   => array_values($data)[0]
        ]);

        die();

    }



}