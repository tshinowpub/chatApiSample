<?php

namespace ChatApiSample\Domain\Chat\Usecase;

use ChatApiSample\Domain\Chat\Repository\UserRepositoryInterface;
use ChatApiSample\Domain\Chat\Entity\User;

class CreateUser
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function createUser(User $user)
    {
        $this->repository->createUser($user);
    }
}
