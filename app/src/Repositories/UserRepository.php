<?php

namespace App\Repositories;

use App\models\UserModel;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {

    protected $entity;

    /**
     * Constructor of user Repository
     * Add value to entity attribute of user model
     *
     * @param UserModel $user - model of entity
     */
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
     * @param array $data - data of new user.
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
     * @param string $username - username of user.
     * @return bool
     */
    public function checkUserExists( string $username ) : bool {

        $this->entity->setUsername($username);

        return $this->entity->checkExistsUser();

    }

    /**
     * Check user email exist
     *
     * @param string $email - email of user.
     * @return bool
     */
    public function checkIfEmailExists( string $email ) : bool {

        $this->entity->setEmail($email);

        return $this->entity->checkExistsEmail();

    }

}