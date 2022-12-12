<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function createUser( array $data );
}