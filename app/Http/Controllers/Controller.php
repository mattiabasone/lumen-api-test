<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Http\ResponseFactory;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /** @var \Laravel\Lumen\Http\ResponseFactory */
    protected $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [];
    }

    /**
     * Execute a form validation.
     *
     * @param Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function executeValidation(Request $request): void
    {
        $this->validate($request, $this->rules());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function buildEntityNotFoundResponse(): \Illuminate\Http\JsonResponse
    {
        return $this->responseFactory->json([
            'ok' => false,
            'error' => 'Entity not found',
        ])->setStatusCode(Response::HTTP_NOT_FOUND);
    }

    /**
     * Set a default failed validation response for all controllers.
     *
     * @param Request $request
     * @param array   $errors
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function buildFailedValidationResponse(Request $request, array $errors): \Illuminate\Http\JsonResponse
    {
        return $this->responseFactory->json([
            'ok' => false,
            'errors' => $errors,
        ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
