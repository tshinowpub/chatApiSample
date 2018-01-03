<?php

namespace ChatApiSample\Domain\Chat\Service;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;

use ChatApiSample\Domain\Chat\Entity\AbstractEntity;

class EntityConverter
{
    private $ignoredAttributes = [];

    public function addIgnoredAttribute(string $ignoredAttribute)
    {
        $this->ignoredAttributes[] = $ignoredAttribute;

        return $this;
    }

    public function setIgnoredAttributes(array $ignoredAttributes)
    {
        $this->ignoredAttributes = $ignoredAttributes;

        return $this;
    }

    public function getIgnoredAttributes()
    {
        return $this->ignoredAttributes;
    }

    public function toArray(AbstractEntity $entity)
    {
        $encoders = array(new JsonEncoder());

        $propertyNormalizer = new PropertyNormalizer();
        if(count($this->getIgnoredAttributes()) > 0) {
            $propertyNormalizer->setIgnoredAttributes($this->getIgnoredAttributes());
        }

        $dateTimeNormalizer = new DateTimeNormalizer(\DateTime::ATOM);

        $normalizers = [
            $propertyNormalizer,
            $dateTimeNormalizer,
        ];

        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($entity, 'json');

        return json_decode($jsonContent, true);
    }
}
