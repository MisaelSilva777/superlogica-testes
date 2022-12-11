<?php

namespace App\Services;

use App\models\UserModel;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService {

    protected $userRepository;

    public function __construct( UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Return all users
     *
     * @return array
    */
    public function getAllUsers() {
        $users = $this->userRepository->getAllUsers();

        return array(
            'data' => $users
        );
    }

    /**
     * Create new user
     *
     * @param array $data - data of new user.
    */
    public function makeUser( array $data ) {

        if ( checkHasEmptyFields( $data ) ) {

            return array(
                'error' => 'É necessário informar todos os campos para inserir um novo usuário.'
            );

        }

        if ( 100 < strlen( $data['name'] ) ) {
            
            return array(
                'error' => 'Nome completo não deve ultrapassar 100 caracteres'
            );

        }

        if ( 30 < strlen( $data['username'] ) ) {
            
            return array(
                'error' => 'Nome de login não deve ultrapassar 30 caracteres'
            );

        }

        if ( strpos( '', $data['username'] ) ) {
            
            return array(
                'error' => 'Nome de login não deve ter espaços em branco'
            );

        }

        if ( ! stringHasOnlyLettersAndNumbers( $data['username'] ) ) {
            
            return array(
                'error' => 'Nome de login deve conter apenas letras e números'
            );

        }

        if ( ! stringIsEmail( $data['email'] ) ) {
            
            return array(
                'error' => 'É necessário informar um e-mail valido.'
            );

        }

        if ( ! stringIsEmail( $data['email'] ) ) {
            
            return array(
                'error' => 'É necessário informar um e-mail valido.'
            );

        }

        return array('a' => '');

        $data = [];
        $user = new UserModel();

        return $this->userRepository->createUser($user);
    }

}