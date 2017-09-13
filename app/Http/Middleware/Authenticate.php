<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepositoryInterface;
use Closure;
use Illuminate\Http\Response;

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
     * @throws \ErrorException
     */
    public function handle($request, Closure $next)
    {
        $username = $request->getUser();
        $password = $request->getPassword();
        if (!$username || !$password) {
            throw new \ErrorException(Response::HTTP_UNAUTHORIZED);
        }

        if (!$user = $this->userRepository->findByUsernameAndPassword($username, $password)) {
            return response('Not allowed', Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
