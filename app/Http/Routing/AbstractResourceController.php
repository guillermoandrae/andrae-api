<?php

namespace App\Http\Routing;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller;

/**
* @SWG\Parameter(
 *      parameter = "limit_query_param",
 *      name="limit",
 *      description="Limits the response size.",
 *      required=false,
 *      type="string",
 *      in="query"
 * ),
 * @SWG\Parameter(
 *      parameter = "offset_query_param",
 *      name="offset",
 *      description="Offsets the collection.",
 *      required=false,
 *      type="string",
 *      in="query"
 * ),
 * @SWG\Parameter(
 *      parameter = "keyword_query_param",
 *      name="q",
 *      description="The search keyword.",
 *      required=false,
 *      type="string",
 *      format="date",
 *      in="query"
 * )
 */

/**
 * @package App\Http\Routing
 */
abstract class AbstractResourceController extends Controller implements ResourceControllerInterface
{
    use JsonResponseBuilderTrait;

    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        try {
            $this->validate($request, [
                'offset' => 'integer',
                'limit' => 'integer',
                'q' => 'alpha_num'
            ]);
            $offset = $request->query('offset');
            $limit = $request->query('limit');
            if ($phrase = $request->query('q')) {
                $result = $this->repository->search($phrase, $offset, $limit);
            } else {
                $result = $this->repository->findAll($offset, $limit);
            }
            return $this->respond($result);
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        try {
            dd($request);
            if (!$data = $request->json()->all()) {
                throw new \ErrorException(ResourceControllerInterface::ERROR_NO_CONTENT, Response::HTTP_BAD_REQUEST);
            }
            $result = $this->repository->create($data);
            return $this->respond($result, Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), $ex->getCode());
        }
    }

    /**
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
            $result = $this->repository->findById((int) $id);
            if (!$result->getId()) {
                return $this->respondWithNotFound();
            }
            return $this->respond($result);
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), $ex->getCode());
        }
    }
}
