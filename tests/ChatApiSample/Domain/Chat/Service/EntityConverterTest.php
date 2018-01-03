<?php

namespace ChatApiSample\Domain\Chat\Service;

use ChatApiSample\Domain\Chat\Entity\User;
use ChatApiSample\Domain\Chat\Service\EntityConverter;

class EntityConverterTest extends \PHPUnit_Framework_TestCase
{

    private $entityConverter;

    public function setUp()
    {
        $this->entityConverter = new EntityConverter();
    }

    /**
     * @test
     */
    public function エンティティを配列に変換する ()
    {
        $user = new User();
        $arrayUser = $this->entityConverter->toArray($user);

        $this->assertTrue(is_array($arrayUser));
    }
}
