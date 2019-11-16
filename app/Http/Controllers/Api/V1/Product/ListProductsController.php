<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Http\Controllers\Controller;
use Domain\Product\Repository\ProductRepository;
use Laravel\Lumen\Http\ResponseFactory;

class ListProductsController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var ResponseFactory
     */
    private $responseFactory;

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
        $this->responseFactory = $responseFactory;
    }

    public function __invoke()
    {
        return $this->responseFactory->json([
            'ok' => true,
            'products' => $this->productRepository->all()
        ]);
    }
}
