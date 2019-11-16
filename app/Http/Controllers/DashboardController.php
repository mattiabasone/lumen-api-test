<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Domain\Product\Repository\ProductRepository;
use Domain\User\Repository\UserRepository;
use Domain\Wishlist\Repository\WishlistRepository;
use Laravel\Lumen\Http\ResponseFactory;
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
     * @param ResponseFactory $responseFactory
     */
    public function __construct(
        UserRepository $userRepository,
        ProductRepository $productRepository,
        WishlistRepository $wishlistRepository,
        ResponseFactory $responseFactory
    ) {
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->wishlistRepository = $wishlistRepository;
        parent::__construct($responseFactory);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $oauthClient = Client::query()
            ->where('password_client', '=',1)
            ->first();
        $users = $this->userRepository->all();
        $products = $this->productRepository->all();
        $wishlists = $this->wishlistRepository->all();

        return $this->responseFactory->make(
            view('dashboard', [
                'oauthClient' => $oauthClient,
                'users' => $users,
                'products' => $products,
                'wishlists' => $wishlists,
            ]), Response::HTTP_OK
        );
    }
}
