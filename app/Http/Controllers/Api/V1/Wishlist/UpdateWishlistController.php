<?php

namespace App\Http\Controllers\Api\V1\Wishlist;

use Auth;
use App\Http\Controllers\Controller;
use Domain\Wishlist\Repository\WishlistRepository;
use Illuminate\Http\Request;
use Laravel\Lumen\Http\ResponseFactory;

class UpdateWishlistController extends Controller
{
    /**
     * @var WishlistRepository
     */
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
        $wishlistId = (int) $id;
        if (!$this->wishlistRepository->exists($wishlistId)) {
            return $this->buildEntityNotFoundResponse();
        }
        $wishlistData = $request->input();
        $wishlistData['user_id'] = Auth::id();

        $this->wishlistRepository->update($wishlistData, $wishlistId);
        $wishlist = $this->wishlistRepository->getById($wishlistId);

        return $this->responseFactory->json([
            'ok' => true,
            'wishlist' => $wishlist->toArray()
        ]);
    }
}
