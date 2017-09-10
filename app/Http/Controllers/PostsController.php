<?php

namespace App\Http\Controllers;

use App\Models\ModelInterface;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller;

class PostsController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    protected $postRepository;

    /**
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     *
     * @api {get} /posts/?q=:keyword Search for Posts
     * @apiName SearchPosts
     * @apiGroup Posts
     * @apiParam {String} keyword Keyword to search for.
     * @apiSuccess {Object[]} List of posts.
     *
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        try {
            $this->validate(
                $request,
                [
                'offset' => 'integer',
                'limit' => 'integer',
                'q' => 'alpha_num'
                ]
            );
            $offset = $request->query('offset');
            $limit = $request->query('limit');
            if ($phrase = $request->query('q')) {
                $result = $this->postRepository->search($phrase, $offset, $limit);
            } else {
                $result = $this->postRepository->findAll($offset, $limit);
            }
            return $this->respond($result);
        } catch (ValidationException $ex) {
            return $this->respondWithError($ex->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage());
        }
    }

    /**
     * @api {get} /posts/:id Request Post by ID
     * @apiName GetPost
     * @apiGroup Posts
     * @apiParam {Number} id Post ID.
     * @apiSuccess {Object} Post.
     *
     * @param integer $id
     * @param Request $request
     * @return mixed
     */
    public function read($id, Request $request)
    {
        try {
            $this->validate(
                $request,
                [
                'id' => 'integer'
                ]
            );
            $result = $this->postRepository->findById((int) $id);
            return $this->respond($result);
        } catch (ValidationException $ex) {
            $this->respondWithError($ex->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (\Exception $ex) {
            $this->respondWithError($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        try {
            $data = $request->json()->all();
            $result = $this->postRepository->create($data);
            return $this->respond($result);
        } catch (ValidationException $ex) {
            return $this->respondWithError($ex->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage());
        }
    }

    /**
     * @param string  $errorMessage
     * @param integer $statusCode
     * @return mixed
     */
    private function respondWithError(string $errorMessage, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json(
            [
            'error' => [
                'status' => $statusCode,
                'detail' => $errorMessage,
            ]
            ]
        )->setStatusCode($statusCode);
    }

    /**
     * @param mixed   $output
     * @param integer $statusCode
     * @return mixed
     */
    private function respond($output, int $statusCode = Response::HTTP_OK)
    {
        $data = [];
        if (is_a($output, ModelInterface::class)) {
            $data = $output->toArray();
        } elseif (isset($output[0]) && is_a($output[0], ModelInterface::class)) {
            foreach ($output as $datum) {
                $data[] = $datum->toArray();
            }
        }
        return response()->json(['data' => $data])->setStatusCode($statusCode);
    }
}
