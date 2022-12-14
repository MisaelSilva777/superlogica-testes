<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    /**
     * Method to get all users
     *
     * @return array
     */
    public function getAllUsers() : array;

    /**
     * Method to create a new user
     *
     * @param array $data - data attributes of user.
     * @return bool
     */
    public function createUser( array $data ) : bool;
}