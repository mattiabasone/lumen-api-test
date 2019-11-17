<?php

namespace App\Http\Controllers\Api\V1\Wishlist;

use Auth;
use App\Http\Controllers\Controller;
use Domain\Product\Repository\ProductRepository;
use Domain\Wishlist\Repository\WishlistRepository;
use Illuminate\Http\Request;
use Laravel\Lumen\Http\ResponseFactory;

class AddProductToWishlistController extends Controller
{
    /** @var WishlistRepository */
    private $wishlistRepository;

    /** @var ProductRepository */
    private $productRepository;

    /**
     * Create a new controller instance.
     *
     * @param WishlistRepository $wishlistRepository
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        $wishlistId = (int) $id;
        if (!$this->wishlistRepository->exists($wishlistId)) {
            return $this->buildEntityNotFoundResponse();
        }

        // TODO: Business logic for adding products

        return $this->responseFactory->json([
            'ok' => true,
            'wishlist' => $wishlist->toArray()
        ]);
    }
}
