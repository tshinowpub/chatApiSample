<?php

namespace ChatApiSample\Primary\WebBundle\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Psr\Log\LoggerInterface;
use ChatApiSample\Domain\Chat\Entity\AbstractEntity;

abstract class AbstractApiController extends Controller
{
    const API_VERSION = 'v1';

    protected $logger;

    protected function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    protected function writeLog(string $message, array $parameter = null)
    {
        $info = [
            'version' => self::API_VERSION,
        ];

        if(!is_null($parameter)) {
            $info['parameter'] = $parameter;
        }

        $this->logger->info($message, $info);
    }

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
