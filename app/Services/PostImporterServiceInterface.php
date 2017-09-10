<?php

namespace App\Services;

use App\Repositories\PostRepositoryInterface;

interface PostImporterServiceInterface
{
    /**
     * @param PostRepositoryInterface $postRepository
     * @param $sourcePath
     */
    public function __construct(PostRepositoryInterface $postRepository, $sourcePath);

    /**
     * @return array
     */
    public function extract(): array;

    /**
     * @param array $extractedData
     * @return array
     */
    public function transform(array $extractedData): array;

    /**
     * @param array $data
     * @return mixed
     */
    public function import(array $data);

    /**
     * @return mixed
     */
    public function getSourcePath();

    /**
     * @return mixed
     */
    public function getSource();
}
