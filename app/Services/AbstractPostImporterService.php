<?php

namespace App\Services;

use App\Repositories\PostRepositoryInterface;

abstract class AbstractPostImporterService implements PostImporterServiceInterface
{
    /**
     * @var PostRepositoryInterface
     */
    protected $postRepository;

    /**
     * @var string
     */
    protected $sourcePath;

    /**
     * @var string
     */
    protected $source;

    /**
     * @param PostRepositoryInterface $postRepository
     * @param $sourcePath
     */
    final public function __construct(PostRepositoryInterface $postRepository, $sourcePath)
    {
        $this->postRepository = $postRepository;
        $this->sourcePath = $sourcePath;
        $this->source = '';
    }

    /**
     * @param array $data
     * @return void
     * @throws \ErrorException
     */
    final public function import(array $data)
    {
        foreach ($data as $postData) {
            if (!$post = $this->postRepository->create($postData)) {
                throw new \ErrorException('Could not create a valid post.');
            }
        }
    }

    /**
     * @return string
     */
    final public function getSource()
    {
        return $this->source;
    }

    /**
     * @return string
     */
    final public function getSourcePath()
    {
        return $this->sourcePath;
    }
}
