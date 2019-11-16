<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Laravel\Lumen\Http\ResponseFactory;

class AuthCheckRole
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
     * Create a new middleware instance.
     *
     * @param \Illuminate\Contracts\Auth\Factory $auth
     * @param ResponseFactory $responseFactory
     */
    public function __construct(
        Auth $auth,
        ResponseFactory $responseFactory
    ) {
        $this->auth = $auth;
        $this->responseFactory = $responseFactory;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param null $guard
     * @param string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null, $role = 'admin')
    {
        if ($this->auth->guard($guard)->user()->role !== $role) {
            return $this->responseFactory->json([
                'ok' => false,
                'error' => 'Unauthorized.'
            ], 401);
        }
        return $next($request);
    }
}
