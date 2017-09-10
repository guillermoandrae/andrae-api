<?php

namespace App\Repositories;

use App\Models\ModelInterface;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    /**
     * @const string
     */
    const DEFAULT_LIMIT = 25;

    /**
     * Retrieves a collection of model objects that meet the provided criteria.
     *
     * @param  string   $phrase
     * @param  int      $offset
     * @param  int|null $limit
     * @return Collection
     */
    public function search(string $phrase, int $offset = null, int $limit = null): Collection;

    /**
     * @return ModelInterface
     */
    public function findLatest(): ModelInterface;

    /**
     * Retrieves a collection of model objects between the provided date range.
     *
     * @param  \DateTime $sinceDateTime
     * @param  int       $offset
     * @param  int|null  $limit
     * @return Collection
     */
    public function findSince(\DateTime $sinceDateTime, int $offset = null, int $limit = null): Collection;

    /**
     * Retrieves a model object by ID.
     *
     * @param  string $id
     * @return ModelInterface
     */
    public function findById(string $id): ModelInterface;

    /**
     * Retrieves a collection of model objects.
     *
     * @param  int      $offset
     * @param  int|null $limit
     * @return Collection
     */
    public function findAll(int $offset = null, int $limit = null): Collection;

    /**
     * Creates a model object.
     *
     * @param  array $data
     * @return ModelInterface
     */
    public function create(array $data): ModelInterface;

    /**
     * Deletes a model object.
     *
     * @param  int $id
     * @return boolean
     */
    public function delete(int $id);
}
