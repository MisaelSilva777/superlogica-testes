<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserService {

    protected $userRepository;

    /**
     * The constructor method of User Service and
     * added your repository to respective attribute
     *
     * @param UserRepositoryInterface $userRepository - Repository of User Entity.
     */
    public function __construct( UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Return all users
     *
     * @return array
    */
    public function getAllUsers() : array {
        $users = $this->userRepository->getAllUsers();

        return [
            'data' => $users
        ];
    }

    /**
     *  Create new user
     *
     * @param array $data - data of new user.
     * @return array
     */
    public function makeUser( array $data ) : array {

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
                'data' => "Erro ao criar usu??rio.",
            ];
        }

        return [
            'data' => "Usu??rio criado com sucesso.",
        ];

    }



    /**
     * Function to return specific error message.
     *
     * @param string $error_type - error type to ref and return your message.
     * @return array
     */
    public function messages( string $error_type ) : array {

        $message = "";

        switch ( $error_type ) {
            case 'empty_fields':
                $message = '?? necess??rio informar todos os campos para inserir um novo usu??rio.';
                break;

            case 'name_limit':
                $message = 'Nome completo deve ser inserido e n??o pode ultrapassar 100 caracteres.';
                break;

            case 'username_limit':
                $message = 'Nome de login deve ser inserido e n??o pode ultrapassar 30 caracteres.';
                break;

            case 'username_empty_space':
                $message = 'Nome de login n??o deve ter espa??os em branco.';
                break;

            case 'username_only_letters_and_numbers':
                $message = 'Nome de login deve conter apenas letras e n??meros.';
                break;

            case 'username_already_exists':
                $message = 'Usu??rio j?? existente, tente outro.';
                break;

            case 'zipcode_limit':
                $message = 'O Cep dever ser inserido n??o pode ultrapassar 100 caracteres.';
                break;

            case 'email_format':
                $message = '?? necess??rio informar um e-mail valido.';
                break;

            case 'email_already_exists':
                $message = 'Email j?? existente, tente outro.';
                break;

            case 'password_format':
                $message = 'A senha deve ser fornecida e conter 8 caracteres no m??nimo, contendo pelo menos 1 letra e 1 n??mero';
                break;

        }

        return [
            'error' => $message
        ];

    }

}