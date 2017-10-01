<?php

namespace Test\Http\Controllers;

use Aws\DynamoDb\DynamoDbClient;
use Illuminate\Http\Response;

class PostsControllerTest extends \TestCase
{
    private static $time;

    /**
     * @var DynamoDbClient
     */
    private static $client;

    public static function setUpBeforeClass()
    {
        /*
        self::$client = app(DynamoDbClient::class);
        self::$time = time();
        self::createDatabase();
        self::seedDatabase();
        */
    }

    public static function tearDownAfterClass()
    {
        //self::destroyDatabase();
    }

    private static function createDatabase()
    {
        self::$client->createTable(array(
            'TableName' => 'posts',
            'AttributeDefinitions' => array(
                array(
                    'AttributeName' => 'id',
                    'AttributeType' => 'S'
                )
            ),
            'KeySchema' => array(
                array(
                    'AttributeName' => 'id',
                    'KeyType'       => 'HASH'
                ),
            ),
            'ProvisionedThroughput' => array(
                'ReadCapacityUnits'  => 10,
                'WriteCapacityUnits' => 10
            )
        ));
        self::$client->createTable(array(
            'TableName' => 'users',
            'AttributeDefinitions' => array(
                array(
                    'AttributeName' => 'id',
                    'AttributeType' => 'S'
                )
            ),
            'KeySchema' => array(
                array(
                    'AttributeName' => 'id',
                    'KeyType'       => 'HASH'
                ),
            ),
            'ProvisionedThroughput' => array(
                'ReadCapacityUnits'  => 10,
                'WriteCapacityUnits' => 10
            )
        ));
    }

    private static function seedDatabase()
    {
        $i = 0;
        foreach (['Twitter', 'Pinterest', 'Spotify'] as $source) {
            self::$client->putItem([
                'TableName' => 'posts',
                'Item' => [
                    'id'                => ['S' => self::$time + $i],
                    'body'              => ['S' => sprintf('This is a post from %s!', $source)],
                    'createdAt'         => ['N' => (string) strtotime('now')],
                    'externalId'        => ['S' => md5($source)],
                    'htmlUrl'           => ['S' => sprintf('https://%s.com/123', strtolower($source))],
                    'originalAuthor'    => ['S' => 'guillermoandrae'],
                    'source'            => ['S' => $source],
                    'thumbnailUrl'      => ['S' => 'https://my.ima.ge'],

                ]
            ]);
            $i++;
        }
        self::$client->putItem([
            'TableName' => 'users',
            'Item' => [
                'id'                => ['S' => time()],
                'createdAt'         => ['N' => (string) strtotime('now')],
                'password'          => ['S' => 'password'],
                'originalAuthor'    => ['S' => 'username'],
            ]
        ]);
    }

    private static function destroyDatabase()
    {
        self::$client->deleteTable([
            'TableName' => 'posts'
        ]);

        self::$client->waitUntil('TableNotExists', [
            'TableName' => 'posts'
        ]);

        self::$client->deleteTable([
            'TableName' => 'users'
        ]);

        self::$client->waitUntil('TableNotExists', [
            'TableName' => 'users'
        ]);
    }

    public function testSearch()
    {
        $response = $this->call('GET', '/posts', ['q' => 'post']);
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
        $response = $this->call('GET', sprintf('/posts/%s', self::$time));
        self::assertSame(Response::HTTP_OK, $response->status());
    }

    public function testReadBadId()
    {
        $response = $this->call('GET', '/posts/foo');
        self::assertSame(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testCreate()
    {
        $response = $this->call('PUT', '/posts', [
            'id'                => time(),
            'body'              => 'Hey',
            'createdAt'         => (string) strtotime('now'),
            'externalId'        => '11111',
            'htmlUrl'           => 'https://wwww',
            'originalAuthor'    => 'guillermoandrae',
            'source'            => 'Twitter',
            'thumbnailUrl'      => 'https://yo.gif',
        ]);
        self::assertSame(Response::HTTP_CREATED, $response->getStatusCode());
    }

    public function setUp()
    {
        parent::setUp();
        $client = app(DynamoDbClient::class);
    }
}
