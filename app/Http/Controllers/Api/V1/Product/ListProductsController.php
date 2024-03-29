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

    public function __invoke()
    {
        return $this->responseFactory->json([
            'ok' => true,
            'products' => $this->productRepository->all()
        ]);
    }
}
