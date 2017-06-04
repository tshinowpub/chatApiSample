<?php

namespace ChatApiSample\Secondary\Persistence\Service;

use ChatApiSample\Domain\Chat\Entity\User;
use ChatApiSample\Domain\Chat\Service\UserFactoryInterface;
use ChatApiSample\Secondary\Persistence\DTO\User as DTOUser;

class UserFactory implements UserFactoryInterface
{
    public function create(): User
    {
        return new DTOUser();
    }
}
