<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface PostRepositoryInterface extends RepositoryInterface
{
    /**
     * Retrieves a collection of posts between the provided date range.
     *
     * @param  string   $source
     * @param  int      $offset
     * @param  int|null $limit
     * @return Collection
     */
    public function findBySource(string $source, int $offset = null, int $limit = null): Collection;
}
