<?php

namespace App\Http\Middleware;

use Closure;
use Domain\Wishlist\Repository\WishlistRepository;
use Illuminate\Contracts\Auth\Factory as Auth;
use Laravel\Lumen\Http\ResponseFactory;

class VerifyWishlistOwnership
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;
    /**
     * @var ResponseFactory
     */
    private $responseFactory;
    /**
     * @var WishlistRepository
     */
    private $wishlistRepository;

    /**
     * Create a new middleware instance.
     *
     * @param \Illuminate\Contracts\Auth\Factory $auth
     * @param WishlistRepository $wishlistRepository
     * @param ResponseFactory $responseFactory
     */
    public function __construct(
        Auth $auth,
        WishlistRepository $wishlistRepository,
        ResponseFactory $responseFactory
    ) {
        $this->auth = $auth;
        $this->responseFactory = $responseFactory;
        $this->wishlistRepository = $wishlistRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param null $guard
     * @param string $routeKey
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null, $routeKey = 'id')
    {
        $wishlistId = (int) $request->route($routeKey);
        /** @var \App\Models\User $user */
        $user = $this->auth->guard($guard)->user();
        if ($this->wishlistRepository->userIsOwner($wishlistId, $user->id) || $user->isAdmin()) {
            return $next($request);
        }

        return $this->responseFactory->json([
            'ok' => false,
            'error' => 'Forbidden.'
        ], 403);

    }
}
