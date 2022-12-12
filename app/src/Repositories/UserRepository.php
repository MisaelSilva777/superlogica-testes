<?php

namespace App\Repositories;

use App\models\UserModel;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {

    protected $entity;

    public function __construct( UserModel $user ) {
        $this->entity = $user;
    }

    /**
     * Get all Categories
     * @return array
     */
    public function getAllUsers() : array {
        return $this->entity->index();
    }

    /**
     * Create new user
     *
     * @param array $data
     * @return bool
     */
    public function createUser( array $data) : bool {

        extract($data);

        $this->entity->setFullName($name);
        $this->entity->setUsername($username);
        $this->entity->setZipcode($zipcode);
        $this->entity->setEmail($email);
        $this->entity->setPassword($password);

        return $this->entity->create();
        
    }

    /**
     * Check user exist
     *
     * @param string $username
     * @return bool
     */
    public function checkUserExists( string $username ) : bool {

        $this->entity->setUsername($username);

        return $this->entity->checkExistsUser();

    }

    /**
     * Check user email exist
     *
     * @param string $email
     * @return bool
     */
    public function checkIfEmailExists( string $email ) : bool {

        $this->entity->setEmail($email);

        return $this->entity->checkExistsEmail();

    }

}