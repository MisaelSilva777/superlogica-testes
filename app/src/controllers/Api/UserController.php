<?php

namespace App\controllers\Api;

use App\interfaces\UserApiInterface;
use App\Services\UserService;

class UserController implements UserApiInterface {

    protected $userService;

    /**
     * Undocumented function
     *
     */
    public function __construct( UserService $categoryService ) {
        $this->userService = $categoryService;
    }


    /**
     * Undocumented function
     *
     */
    public function index() : void {

        $users = $this->userService->getAllUsers();
        $this->httpResponde( 200, $users );
        
    }

    /**
     * Undocumented function
     *
	 * @param array      $data - data of new element
     */
    public function create( array $data ) : void {

        $user = $this->userService->makeUser( $data);

        if ( ! empty( $user['error'] ) ) {
            $this->httpResponde( 200, $user );
        }

        $this->httpResponde( 200, $user );

    }

    /**
     * Undocumented function
     *
     * @param string $status
     * @param mixed $data
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