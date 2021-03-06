<?php

namespace ChatApiSample\Primary\WebBundle\Controller\Api\V1;

use ChatApiSample\Primary\WebBundle\Controller\Api\V1\AbstractApiController;
use ChatApiSample\Primary\WebBundle\Form\CreateUserType;
use ChatApiSample\Primary\WebBundle\Form\GetUserType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractApiController
{
    const API_VERSION = 'v1';

    const STATUS_SUCCESS = 200;
    const STATUS_CREATED = 201;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_NOT_FOUND = 404;

    const ERROR_CODE_BAD_REQUEST = 'BAD_VALUE';
    const ERROR_CODE_RESOURCE_NOT_FOUND = 'RESOURCE_NOT_FOUND';
    const ERROR_CODE_UNAUTHORIZED = 'UNAUTHORIZED';

    /**
     * @Route("/api/v1/user/create", name="api_user_create")
     * @Method("POST")
     */
    public function apiUserCreateAction(Request $request)
    {
        $this->setLogger($this->get('logger.create_user_logger'));
        $this->writeLog('api access api_user_create');

        if(!$this->isAuthorized($request->query->get('apiKey'))) {

            $this->writeLog('create_user resource_not_found', $request->query->all());

            return new JsonResponse([
                "error_code" => self::ERROR_CODE_UNAUTHORIZED,
            ], self::STATUS_UNAUTHORIZED);
        }

        $user = $this->get('service.user_factory')->create();
        $form = $this->createForm(CreateUserType::class, $user);

        $data = $request->query->all();

        $form->submit($data);
        $form->handleRequest($request);

        $errors = [];
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());

            $user->setPassword($password);

            $createUser = $this->get('usecase.create_user');
            $createUser->createUser($user);

            $responseCreateUser = $this->toArrayFromEntity($user, $user->getApiIgnoreProperty());

            $this->writeLog('api api_user_create success', $responseCreateUser);

        } else {

            $errors = $this->getErrorMessages($form);

            $this->writeLog('create_user invalid', $data);
            
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

    /**
     * @Route("/api/v1/user/get/{id}", name="api_get_user")
     * @Method("GET")
     */
    public function apiGetUserAction(Request $request, $id)
    {
        $this->setLogger($this->get('logger.get_user_logger'));
        $this->writeLog('api access api_get_user');

        if(!$this->isAuthorized($request->query->get('apiKey'))) {

            $this->writeLog('get_user resource_not_found', $request->query->all());

            return new JsonResponse([
                "error_code" => self::ERROR_CODE_UNAUTHORIZED,
            ], self::STATUS_UNAUTHORIZED);
        }

        $form = $this->createForm(GetUserType::class);

        $request->query->set('id', $id);
        $data = $request->query->all();

        $form->submit($data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $getUser = $this->get('usecase.get_user');
            $user = $getUser->getUser($id);

            if(is_null($user)) {

                $this->writeLog('get_user resource_not_found', $data);

                return new JsonResponse([
                    "error_code" => self::ERROR_CODE_RESOURCE_NOT_FOUND,
                ], self::STATUS_NOT_FOUND);
            }

            $responseUser = $this->toArrayFromEntity($user, $user->getApiIgnoreProperty());

        }  else {

            $errors = $this->getErrorMessages($form);

            $this->writeLog('get_user invalid', $data);

            return new JsonResponse([
                "error_code" => self::ERROR_CODE_BAD_REQUEST,
                'errors' => $errors,
            ], self::STATUS_BAD_REQUEST);
        }

        return new JsonResponse(
            $responseUser,
            self::STATUS_SUCCESS
        );
    }

}
