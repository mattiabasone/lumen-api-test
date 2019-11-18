<?php

namespace App\Http\Controllers\Api\V1\Wishlist;

use Auth;
use App\Http\Controllers\Controller;
use Domain\Product\Repository\ProductRepository;
use Domain\Wishlist\Repository\WishlistRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Http\ResponseFactory;

class RemoveProductToWishlistController extends Controller
{
    /**
     * @var WishlistRepository
     */
    private $wishlistRepository;

    private $productRepository;

    /**
     * Create a new controller instance.
     *
     * @param WishlistRepository $wishlistRepository
     * @param ProductRepository $productRepository
     * @param ResponseFactory $responseFactory
     */
    public function __construct(
        WishlistRepository $wishlistRepository,
        ProductRepository $productRepository,
        ResponseFactory $responseFactory
    ) {
        $this->wishlistRepository = $wishlistRepository;
        $this->productRepository = $productRepository;
        parent::__construct($responseFactory);
    }

    /**
     * @param Request $request
     * @param $id
     * @param $product_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, $id, $product_id)
    {
        $wishlist = $this->wishlistRepository->getById((int) $id);
        $product = $this->productRepository->getById((int) $product_id);

        if ($wishlist === null || $product === null) {
            return $this->responseFactory->json([
                'ok' => false,
                'error' => 'Invalid data'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->wishlistRepository->removeProduct($wishlist, $product);

        return $this->responseFactory->json([
            'ok' => true,
        ]);
    }
}
