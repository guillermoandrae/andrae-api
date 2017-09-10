<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Repositories\PostRepositoryInterface;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller;

class PostController extends Controller
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
     * @param integer $id
     * @return View
     */
    public function index($id)
    {
        $post = $this->postRepository->findById($id);
        if (!$post->getId()) {
            abort(404);
        }
        return view('post', [
            'post' => [
                'uri'           => sprintf('post/%s/%s', $id, $post->getSlug()),
                'title'         => $post->getTitle(),
                'description'   => $post->getDescription(),
                'image'         => explode(',', $post->getThumbnailUrl())[0],
                'datetime'      => $post->getCreatedAt()->format(DATE_ATOM),
                'time'          => $post->getCreatedAt()->format(DATE_RSS),
                'summary'       => $post->getSummary(),
                'body'          => $post->getBody(),
                'action'        => $post->getAction(),
                'source'        => strtolower($post->getSource())
            ]
        ]);
    }
}
