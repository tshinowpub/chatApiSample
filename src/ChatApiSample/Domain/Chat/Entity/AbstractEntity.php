<?php

namespace ChatApiSample\Domain\Chat\Entity;

use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractEntity
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @Assert\NotNull()
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @Assert\NotNull()
     */
    protected $updatedAt;

    /**
     * @var integer
     */
    protected $version;

    /**
     * @var \DateTime
     */
    protected $deletedAt;


    public function __construct()
    {
        $now = new \DateTime();

        $this->setCreatedAt($now);
        $this->setUpdatedAt($now);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setVersion(int $version)
    {
        $this->version = $version;

        return $this;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setDeletedAt(\DateTime $deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}
