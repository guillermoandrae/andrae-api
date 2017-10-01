<?php

namespace App\Http\Middleware;

use App\Http\Routing\JsonResponseBuilderTrait;
use App\Repositories\UserRepositoryInterface;
use Closure;

class Authenticate
{
    use JsonResponseBuilderTrait;

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
        try {
            if (!$user = $this->userRepository->findByUsernameAndPassword($username, $password)) {
                return $this->respondWithUnauthorized();
            }
        } catch (\Exception $ex) {
            die($ex->getMessage());
        }

        dd('gugug');
        return $next($request);
    }
}
