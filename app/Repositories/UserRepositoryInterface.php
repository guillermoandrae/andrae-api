<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * Retrieves a collection of posts between the provided date range.
     *
     * @param  string   $username
     * @param  string   $password
     * @return Collection
     */
    public function findByUsernameAndPassword(string $username, string $password);
}
