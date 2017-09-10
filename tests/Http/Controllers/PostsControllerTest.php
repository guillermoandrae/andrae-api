<?php

namespace Test\Http\Controllers;

use App\Models\Post;
use App\Repositories\DynamoDb\PostRepository;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class PostsControllerTest extends \TestCase
{
    public function testSearch()
    {
        $response = $this->call('GET', '/posts', ['q' => 'foo']);
        self::assertContains('guillermoandrae', $response->content());
    }

    public function testSearchFindAll()
    {
        $response = $this->call('GET', '/posts');
        self::assertContains('all', $response->content());
    }

    public function testRead()
    {
        $response = $this->call('GET', '/posts/1');
        self::assertContains('first', $response->content());
    }

    public function testCreate()
    {
        self::markTestSkipped('Skipping until we can get everything else working.');
        $response = $this->call('PUT', '/posts', ['externalId' => 'foo']);
        self::assertContains('foo', $response->content());
    }

    public function testBadRequest()
    {
        $mockRepository = $this->getMockBuilder(PostRepository::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->getMock();
        $mockRepository->method('findAll')
            ->willThrowException(new ValidationException('Invalid request'));
        $this->app->bind(PostRepositoryInterface::class, function () use ($mockRepository) {
            return $mockRepository;
        });
        $response = $this->call('GET', '/posts');
        self::assertContains('error', $response->content());
    }

    public function testInternalServerError()
    {
        $mockRepository = $this->getMockBuilder(PostRepository::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->getMock();
        $mockRepository->method('findAll')
            ->willThrowException(new \ErrorException);
        $this->app->bind(PostRepositoryInterface::class, function () use ($mockRepository) {
            return $mockRepository;
        });
        $response = $this->call('GET', '/posts');
        self::assertContains('error', $response->content());
    }

    public function setUp()
    {
        parent::setUp();
        $mockRepository = $this->getMockBuilder(PostRepository::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->getMock();
        $mockRepository->method('search')
            ->with('foo')
            ->willReturn(new Collection([
                new Post(['originalAuthor' => 'guillermoandrae'])
            ]));
        $mockRepository->method('findAll')
            ->willReturn(new Collection([
                new Post(['body' => 'all'])
            ]));
        $mockRepository->method('findById')
            ->with(1)
            ->willReturn(new Post(['body' => 'This is the first post.']));
        $mockRepository->method('create')
            ->willReturn(new Collection([
                new Post(['externalId' => 'foo'])
            ]));
        $this->app->bind(PostRepositoryInterface::class, function () use ($mockRepository) {
            return $mockRepository;
        });
    }
}
