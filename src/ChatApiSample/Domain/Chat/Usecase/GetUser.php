<?php

namespace ChatApiSample\Domain\Chat\Usecase;

use ChatApiSample\Domain\Chat\Repository\UserRepositoryInterface;

class GetUser
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getUser(int $id)
    {
        return $this->repository->getUser($id);
    }
}
