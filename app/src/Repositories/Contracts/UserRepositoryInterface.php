<?php

namespace App\Repositories\Contracts;

use App\models\UserModel;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function createUser( UserModel $user );
}