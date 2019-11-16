<?php

namespace App\Http\Controllers\Api\V1\Wishlist;

use Auth;
use App\Http\Controllers\Controller;
use Domain\Wishlist\Repository\WishlistRepository;
use Illuminate\Http\Request;
use Laravel\Lumen\Http\ResponseFactory;

class StoreWishlistController extends Controller
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

    protected function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }

    public function __invoke(Request $request)
    {
        $wishlistData = $request->input();
        $wishlistData['user_id'] = Auth::id();

        $wishlist = $this->wishlistRepository->create($wishlistData);
        return $this->responseFactory->json([
            'ok' => true,
            'wishlist' => $wishlist->toArray()
        ]);
    }
}
