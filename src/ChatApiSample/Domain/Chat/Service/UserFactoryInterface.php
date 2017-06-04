<?php

namespace ChatApiSample\Domain\Chat\Service;

use ChatApiSample\Domain\Chat\Entity\User;

interface UserFactoryInterface
{
    public function create(): User;
}
