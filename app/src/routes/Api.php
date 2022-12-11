<?php

namespace App\routes;

use App\controllers\Api\UserController;
use App\models\UserModel;
use App\Repositories\UserRepository;
use App\Services\UserService;

/**
 * File to define API Routes.
 *
 */
class Api {

    /**
     * Path of request
     *
     * @var string
     */
    private $path;

    /**
     * Method of request
     */
    private $method;

    /**
     * Constructor of class
     */
    public function __construct(){

        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->path   = $_SERVER["REQUEST_URI"];

        preg_match_all('/(.*)\/?\?/', $this->path, $matches);

        $this->path = $matches[1][0] ?? $this->path;

        if (  '/' == $this->path[-1] ) {
            $this->path = rtrim($this->path, "/" );
        }

        $this->sendToRoute( $this->method, $this->path );

    }

    /**
     * Method to send request to your route
     *
     * @param string $method - method of request
     * @param string $path   - path of request
     * @return void
     */
    private function sendToRoute( string $method, string $path ) {

        header('Content-Type: application/json; charset=utf-8');

        $group = '/'. PATH_API . '/api';

        switch ( $method ) {

            case 'GET':
                $this->getRoutes( $group, $path );
                break;

            case 'POST':
                $this->postRoutes( $group, $path );

                break;

        }

    }

    /**
     * Method to set Get routes
     *
     * @param string $group - group of route, eg index.php/api
     * @param string $path  - path of request, eg /forms
     * @return void
     */
    private function getRoutes( string $group, string $path ) {

        if ( $group . '/forms' === $path ) {

            $user = $this->getUserController();
            return $user->index();

        };

        $this->notFound();

    }

    /**
     * Method to set Post routes
     *
     * @param string $group - group of route, eg index.php/api
     * @param string $path  - path of request, eg /form
     * @return void
     */
    private function postRoutes( string $group, string $path ) {

        if ( $group . '/form' === $path ) {

           
            $user = $this->getUserController();
            return $user->create( $_POST );

        };

        $this->notFound();

    }

    protected function getUserController(){

        $userModel      = new UserModel();
        $userRepository = new UserRepository( $userModel );
        $userService    = new UserService( $userRepository );

        return new UserController( $userService );

    }

    /**
     * Api route not found method
     *
     * @return void
     */
    public function notFound() : void {

        http_response_code(404);
        echo json_encode([
            'status' => 404,
            'error' => 'route not found'
        ]);

    }


}

