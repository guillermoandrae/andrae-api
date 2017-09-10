<?php

namespace App\Http\Middleware;

use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * Create a new middleware instance.
     *
     * @param UserRepositoryInterface $userRepository
     * @return Authenticate
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $username = $request->getUser();
        $password = $request->getPassword();
        if (!$username || !$password) {
            throw new \Exception(403);
        }

        if (!$user = $this->userRepository->findByUsernameAndPassword($username, $password)) {
            return response('Not allowed', 403);
        }
        return $next($request);
    }
}
