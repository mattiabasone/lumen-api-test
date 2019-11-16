<?php

namespace App\Http\Controllers\Api\V1\Wishlist;

use Auth;
use App\Http\Controllers\Controller;
use Domain\Wishlist\Repository\WishlistRepository;
use Laravel\Lumen\Http\ResponseFactory;

class ListWishlistsController extends Controller
{
    /**
     * @var WishlistRepository
     */
    private $wishlistRepository;
    /**
     * @var ResponseFactory
     */
    private $responseFactory;

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
        $this->responseFactory = $responseFactory;
    }

    public function __invoke()
    {
        return $this->responseFactory->json([
            'ok' => true,
            'wishlists' => $this->wishlistRepository->allForUser(Auth::id())
        ]);
    }
}
