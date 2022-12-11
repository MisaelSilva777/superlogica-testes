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
     * @param array $category
     * @return bool
     */
    public function createUser( UserModel $user) : bool {
        return $this->entity->create($user);
    }

}