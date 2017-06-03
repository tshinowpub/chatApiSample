<?php

namespace ChatApiSample\Secondary\Persistence\Repository;

use ChatApiSample\Secondary\Persistence\Repository\AbstractEntityRepository;
use ChatApiSample\Secondary\Persistence\DTO\User as OrmUser;
use ChatApiSample\Domain\Chat\Repository\UserRepositoryInterface;
use ChatApiSample\Domain\Chat\Entity\User;

class UserRepository extends AbstractEntityRepository implements UserRepositoryInterface
{

    public function createUser(User $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

}
