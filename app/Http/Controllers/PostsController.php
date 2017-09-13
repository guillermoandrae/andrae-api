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

    /**
     * @SWG\Get(
     *  path="/posts",
     *  summary="Returns a list of resources",
     *  @SWG\Parameter(ref="#/parameters/limit_query_param"),
     *  @SWG\Parameter(ref="#/parameters/offset_query_param"),
     *  @SWG\Parameter(ref="#/parameters/keyword_query_param"),
     *  @SWG\Response(
     *   response=200,
     *   description="Successful search",
     *   @SWG\Schema(
     *     type="array",
     *     @SWG\Items(ref="#/definitions/Post")
     *    ),
     *  )
     * )
     */
}
