<?php

namespace App\Http\Controllers\Api\V1\Wishlist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Lumen\Http\ResponseFactory;
use Domain\Wishlist\Repository\WishlistRepository;

class ListProductsOnWishlistController extends Controller
{
    /** @var WishlistRepository */
    private $wishlistRepository;

    /**
     * Create a new controller instance.
     *
     * @param WishlistRepository $wishlistRepository
     * @param ResponseFactory $responseFactory
     */
    public function __construct(
        WishlistRepository $wishlistRepository,
        ResponseFactory $responseFactory
    ) {
        $this->wishlistRepository = $wishlistRepository;
        parent::__construct($responseFactory);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        $wishlist = $this->wishlistRepository->getById((int) $id);

        return $this->responseFactory->json([
            'ok' => true,
            'wishlist_products' => $wishlist->products ?? []
        ]);
    }
}
