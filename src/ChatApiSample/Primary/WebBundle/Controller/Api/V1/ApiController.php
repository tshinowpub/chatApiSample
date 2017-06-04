<?php

namespace ChatApiSample\Primary\WebBundle\Controller\Api\V1;

use ChatApiSample\Primary\WebBundle\Controller\Api\V1\AbstractApiController;
use ChatApiSample\Primary\WebBundle\Form\CreateUserType;
use ChatApiSample\Secondary\Persistence\DTO\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractApiController
{
    const API_VERSION = 'v1';

    const STATUS_BAD_REQUEST = 400;
    const STATUS_CREATED = 201;

    const ERROR_CODE_BAD_REQUEST = 'BAD_VALUE';

    /**
     * @Route("/api/v1/user/create", name="api_user_create")
     */
    public function apiUserCreateAction(Request $request)
    {
        $logger = $this->get('logger.create_user_logger');
        $logger->info('api access api_user_create', [
            'version' => self::API_VERSION,
        ]);

        $user = new User();
        $form = $this->createForm(CreateUserType::class, $user);

        $data = $request->query->all();

        $form->submit($data);
        $form->handleRequest($request);

        $errors = [];
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $createUser = $this->get('usecase.create_user');
            $createUser->createUser($user);

            $responseCreateUser = $this->toArrayFromEntity($user, [
                'role',
                'password',
            ]);

            $logger->info('api api_user_create success', [
                'version' => self::API_VERSION,
                'parameter' => $responseCreateUser,
            ]);

        } else {

            foreach ($form as $fieldName => $formField) {
                $formFieldErrors = $formField->getErrors(true);
                foreach ($formFieldErrors as $formFieldError) {
                    $errors[$fieldName][] = $formFieldError->getMessage();
                }
            }

            $logger->info('create_user invalid', [
                'version' => self::API_VERSION,
                'parameter' => $data,
            ]);

            return new JsonResponse([
                "error_code" => self::ERROR_CODE_BAD_REQUEST,
                'errors' => $errors,
            ], self::STATUS_BAD_REQUEST);
        }

        return new JsonResponse(
            $responseCreateUser,
            self::STATUS_CREATED
        );
    }

}
