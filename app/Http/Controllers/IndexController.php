<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Repositories\PostRepositoryInterface;
use Laravel\Lumen\Routing\Controller;

class IndexController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $post = $this->postRepository->findLatest();
        return view('index', [
            'post' => [
                'datetime'  => $post->getCreatedAt()->format(DATE_ATOM),
                'time'      => $post->getCreatedAt()->format(DATE_RSS),
                'summary'   => $post->getSummary(),
                'action'    => $post->getAction(),
                'source'    => strtolower($post->getSource())
            ]
        ]);
    }
}
