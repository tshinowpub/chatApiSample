<?php

namespace ChatApiSample\Domain\Chat\Usecase;

use ChatApiSample\Domain\Chat\Entity\User;
use ChatApiSample\Domain\Chat\Repository\UserRepositoryInterface;

class CreateUserTest extends \PHPUnit_Framework_TestCase
{
    private $userRepository;

    public function setUp()
    {
        $this->userRepository = \Phake::mock(UserRepositoryInterface::class);
    }

    /**
     * @test
     */
    public function ユーザーを作成できる ()
    {
        $user = new User();

        $this->userRepository->createUser($user);

        \Phake::verify($this->userRepository, \Phake::times(1))->createUser($user);
    }
}
