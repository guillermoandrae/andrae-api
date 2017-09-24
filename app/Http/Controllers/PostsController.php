<?php

namespace App\Http\Controllers;

use App\Http\Routing\AbstractResourceController;
use App\Repositories\PostRepositoryInterface;

class PostsController extends AbstractResourceController
{
    /**
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->repository = $postRepository;
    }
}
