<?php

namespace ChatApiSample\Domain\Chat\Usecase;

use ChatApiSample\Domain\Chat\Repository\UserRepositoryInterface;

class GetUserTest extends \PHPUnit_Framework_TestCase
{
    private $userRepository;

    public function setUp()
    {
        $this->userRepository = \Phake::mock(UserRepositoryInterface::class);
    }

    /**
     * @test
     */
    public function ユーザーを取得する ()
    {
        $id = 1;

        $this->userRepository->getUser($id);

        \Phake::verify($this->userRepository, \Phake::times(1))->getUser($id);
    }
}
