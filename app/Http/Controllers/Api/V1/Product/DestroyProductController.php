<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Http\Controllers\Controller;
use Domain\Product\Repository\ProductRepository;
use Illuminate\Http\Request;
use Laravel\Lumen\Http\ResponseFactory;

/**
 * Class DestroyProductController
 */
class DestroyProductController extends Controller
{
    /** @var ProductRepository */
    private $productRepository;

    /**
     * Create a new controller instance.
     *
     * @param ProductRepository $productRepository
     * @param ResponseFactory $responseFactory
     */
    public function __construct(
        ProductRepository $productRepository,
        ResponseFactory $responseFactory
    ) {
        $this->productRepository = $productRepository;
        parent::__construct($responseFactory);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(Request $request, $id)
    {
        $productId = (int) $id;
        if (!$this->productRepository->exists($productId)) {
            return $this->buildEntityNotFoundResponse();
        }

        $this->productRepository->destroy($productId);

        return $this->responseFactory->json([
            'ok' => true
        ]);
    }
}
