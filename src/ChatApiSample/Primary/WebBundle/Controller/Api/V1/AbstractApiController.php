<?php

namespace ChatApiSample\Primary\WebBundle\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;

abstract class AbstractApiController extends Controller
{
    protected function toArrayFromEntity($entity, $ignoredAttributes = [])
    {
        $encoders = array(new JsonEncoder());

        $propertyNormalizer = new PropertyNormalizer();
        if(count($ignoredAttributes) > 0) {
            $propertyNormalizer->setIgnoredAttributes($ignoredAttributes);
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
