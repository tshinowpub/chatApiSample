<?php

namespace ChatApiSample\Domain\Chat\Repository;

use ChatApiSample\Domain\Chat\Entity\User;

interface UserRepositoryInterface
{
    public function createUser(User $user);

    public function getUser(int $id);
}
