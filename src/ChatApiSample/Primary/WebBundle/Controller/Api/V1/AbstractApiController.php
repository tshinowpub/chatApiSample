<?php

namespace ChatApiSample\Primary\WebBundle\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ChatApiSample\Domain\Chat\Entity\AbstractEntity;

abstract class AbstractApiController extends Controller
{
    protected function toArrayFromEntity(AbstractEntity $entity, array $ignoredAttributes = [])
    {
        $entityConverter = $this->get('service.entity_converter');
        $entityConverter->setIgnoredAttributes($ignoredAttributes);

        return $entityConverter->toArray($entity);
    }

    protected function getErrorMessages($form)
    {
        $errors = [];
        foreach ($form as $fieldName => $formField) {
            $formFieldErrors = $formField->getErrors(true);
            foreach ($formFieldErrors as $formFieldError) {
                $errors[$fieldName][] = $formFieldError->getMessage();
            }
        }

        return $errors;
    }

    protected function isAuthorized($apiKey)
    {
        return $this->getParameter('apiKey') == $apiKey;
    }

}
