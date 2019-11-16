<?php

namespace App\Http\Controllers;

use Domain\Product\Repository\ProductRepository;
use Domain\User\Repository\UserRepository;
use Domain\Wishlist\Repository\WishlistRepository;
use Laravel\Passport\Client;

class DashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var WishlistRepository
     */
    private $wishlistRepository;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepository
     * @param ProductRepository $productRepository
     * @param WishlistRepository $wishlistRepository
     */
    public function __construct(
        UserRepository $userRepository,
        ProductRepository $productRepository,
        WishlistRepository $wishlistRepository
    ) {
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->wishlistRepository = $wishlistRepository;
    }

    public function __invoke()
    {
        $oauthClient = Client::query()
            ->where('password_client', 1)
            ->first();
        $users = $this->userRepository->all();
        $products = $this->productRepository->all();
        $wishlists = $this->wishlistRepository->all();
        return view(
            'dashboard',
            [
                'oauthClient' => $oauthClient,
                'users' => $users,
                'products' => $products,
                'wishlists' => $wishlists,
            ]
        );
    }
}
