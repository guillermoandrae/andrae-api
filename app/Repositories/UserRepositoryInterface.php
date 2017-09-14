<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * Retrieves a collection of posts between the provided date range.
     *
     * @param  mixed   $username
     * @param  mixed   $password
     * @return Collection
     */
    public function findByUsernameAndPassword($username, $password);
}
