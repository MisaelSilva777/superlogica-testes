<?php

namespace App\Services;

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

        return [
            'data' => $users
        ];
    }

    /**
     * Create new user
     *
     * @param array $data - data of new user.
    */
    public function makeUser( array $data ) {

        if ( UserValidator::checkHasEmptyFields( $data ) ) {

            return $this->messages('empty_fields');

        }

        extract( $data );

        if ( empty( $name ) || 100 < strlen( $name ) ) {

            return $this->messages('name_limit');

        }

        if ( empty( $username ) || 30 < strlen( $username ) ) {

            return $this->messages('username_limit');

        }

        if ( strpos( '', $username ) ) {

            return $this->messages('username_empty_space');

        }

        if ( empty( $username ) || ! UserValidator::stringHasOnlyLettersAndNumbers( $username, $this->userRepository ) ) {

            return $this->messages('username_only_letters_and_numbers');

        }

        if ( UserValidator::checkIfUserExists( $username, $this->userRepository ) ) {

            return $this->messages('username_already_exists');

        }

        if ( empty( $zipcode ) || 100 < strlen( $zipcode ) ) {

            return $this->messages('zipcode_limit');

        }

        if ( empty( $email ) || ! UserValidator::stringIsEmail( $email ) ) {

            return $this->messages('email_format');

        }

        if ( UserValidator::checkIfEmailExists( $email, $this->userRepository ) ) {

            return $this->messages('email_already_exists');

        }

        if ( empty( $password ) ||  ! UserValidator::validatePassword( $password ) ) {

            return $this->messages('password_format');

        }

        $user = $this->userRepository->createUser($data);

        if ( ! $user ) {
            return [
                'data' => "Erro ao criar usuário.",
            ];
        }

        return [
            'data' => "Usuário criado com sucesso.",
        ];

    }




    public function messages( string $error_type ) : array {

        $message = "";

        switch ( $error_type ) {
            case 'empty_fields':
                $message = 'É necessário informar todos os campos para inserir um novo usuário.';
                break;

            case 'name_limit':
                $message = 'Nome completo deve ser inserido e não pode ultrapassar 100 caracteres.';
                break;

            case 'username_limit':
                $message = 'Nome de login deve ser inserido e não pode ultrapassar 30 caracteres.';
                break;

            case 'username_empty_space':
                $message = 'Nome de login não deve ter espaços em branco.';
                break;

            case 'username_only_letters_and_numbers':
                $message = 'Nome de login deve conter apenas letras e números.';
                break;

            case 'username_already_exists':
                $message = 'Usuário já existente, tente outro.';
                break;

            case 'zipcode_limit':
                $message = 'O Cep dever ser inserido não pode ultrapassar 100 caracteres.';
                break;

            case 'email_format':
                $message = 'É necessário informar um e-mail valido.';
                break;

            case 'email_already_exists':
                $message = 'Email já existente, tente outro.';
                break;

            case 'password_format':
                $message = 'A senha deve ser fornecida e conter 8 caracteres no mínimo, contendo pelo menos 1 letra e 1 número';
                break;

        }

        return [
            'error' => $message
        ];

    }

}