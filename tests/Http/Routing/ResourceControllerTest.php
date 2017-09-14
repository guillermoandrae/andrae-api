<?php

namespace Test\Http\Routing;

use App\Http\Routing\ResourceControllerInterface;
use App\Models\AbstractModel;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ResourceControllerTest extends \TestCase
{
    public function testSearch()
    {
        $response = $this->call('GET', '/posts', ['q' => 'yo']);
        self::assertContains('createdAt', $response->content());
    }

    public function testSearchFindAll()
    {
        $response = $this->call('GET', '/posts');
        self::assertContains('createdAt', $response->content());
    }

    public function testSearchBadQuery()
    {
        $response = $this->call('GET', '/posts', ['limit' => 'yo']);
        self::assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testRead()
    {
        $response = $this->call('GET', '/posts/1');
        self::assertContains('createdAt', $response->content());
    }

    public function testReadBadId()
    {
        $response = $this->call('GET', '/posts/foo');
        self::assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testCreate()
    {
        $username = 'foo';
        $password = 'bar';
        $mockUserRepository = $this->getMockUserRepository();
        $mockUserRepository->method('findByUsernameAndPassword')
            ->with($username, $password)
            ->willReturn(true);
        $this->bindMock(UserRepositoryInterface::class, $mockUserRepository);
        $response = $this->putPosts($username, $password, json_encode(['hey' => 'you']));
        self::assertContains('createdAt', $response->content());
    }

    public function testCreateNoCredentials()
    {
        $mockUserRepository = $this->getMockUserRepository();
        $mockUserRepository->method('findByUsernameAndPassword')
            ->willReturn(false);
        $this->bindMock(UserRepositoryInterface::class, $mockUserRepository);
        $response = $this->call('PUT', '/posts');
        self::assertContains(ResourceControllerInterface::ERROR_UNAUTHORIZED, $response->content());
    }

    public function testCreateNoData()
    {
        $mockUserRepository = $this->getMockUserRepository();
        $mockUserRepository->method('findByUsernameAndPassword')
            ->willReturn(true);
        $this->bindMock(UserRepositoryInterface::class, $mockUserRepository);
        $response = $this->putPosts();
        self::assertContains(ResourceControllerInterface::ERROR_NO_CONTENT, $response->content());
    }

    public function testBadRequest()
    {
        $mockRepository = $this->getMockPostRepository();
        $mockRepository->method('findAll')
            ->willThrowException(new \Exception('Invalid request'));
        $this->bindMock(PostRepositoryInterface::class, $mockRepository);
        $response = $this->call('GET', '/posts');
        self::assertContains('error', $response->content());
    }

    public function testInternalServerError()
    {
        $mockRepository = $this->getMockPostRepository();
        $mockRepository->method('findAll')
            ->willThrowException(new \ErrorException);
        $this->bindMock(PostRepositoryInterface::class, $mockRepository);
        $response = $this->call('GET', '/posts');
        self::assertContains('error', $response->content());
    }

    public function setUp()
    {
        parent::setUp();

        $mockModel = $this->getMockBuilder(AbstractModel::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->getMock();

        $collection = new Collection([$mockModel]);

        $mockPostRepository = $this->getMockPostRepository();
        $mockPostRepository->method('search')->with('yo')->willReturn($collection);
        $mockPostRepository->method('findAll')->willReturn($collection);
        $mockPostRepository->method('create')->willReturn($mockModel);
        $mockPostRepository->method('findById')->with(1)->willReturn($mockModel);
        $this->bindMock(PostRepositoryInterface::class, $mockPostRepository);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockPostRepository():\PHPUnit_Framework_MockObject_MockObject
    {
        $mockRepository = $this->getMockBuilder(PostRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->getMock();
        return $mockRepository;
    }

    private function getMockUserRepository():\PHPUnit_Framework_MockObject_MockObject
    {
        $mockUserRepository = $this->getMockBuilder(UserRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->getMock();
        return $mockUserRepository;
    }

    private function bindMock($className, $class)
    {
        $this->app->bind(
            $className,
            function () use ($class) {
                return $class;
            }
        );
    }

    private function putPosts($username = '', $password = '', $content = null)
    {
        return $this->call(
            'PUT',
            '/posts',
            [],
            [],
            [],
            ['PHP_AUTH_USER' => $username, 'PHP_AUTH_PW' => $password],
            $content
        );
    }
}
