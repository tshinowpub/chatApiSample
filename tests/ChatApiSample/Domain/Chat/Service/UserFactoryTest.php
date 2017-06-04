<?php

namespace ChatApiSample\Domain\Chat\Service;

use ChatApiSample\Secondary\Persistence\DTO\User as DTOUser;
use ChatApiSample\Secondary\Persistence\Service\UserFactory;

class UserFactoryTest extends \PHPUnit_Framework_TestCase
{

    private $userFactory;

    public function setUp()
    {
        $this->userFactory = new UserFactory();
    }

    /**
     * @test
     */
    public function ユーザーオブジェクトを作成する ()
    {
        $DTOUser = $this->userFactory->create();
        $this->assertTrue($DTOUser instanceof DTOUser);
    }
}
