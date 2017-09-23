<?php


namespace Test\Repositories\DynamoDb;

class MockRepositoryDataFactory
{
    private static $data = [
        'post' => [
            [
                'id' => 1,
                'externalId' => 2,
                'source' => 'Twitter',
                'originalAuthor' => 'guillermoandrae',
                'body' => 'This is a tweet!',
                'htmlUrl' => 'https://this.tweet',
                'thumbnailUrl' => 'https://this.jpg',
                'createdAt' => 1505434551,
            ],
            [
                'id' => 2,
                'externalId' => 9,
                'source' => 'Pinterest',
                'originalAuthor' => 'guillermoandrae',
                'body' => 'This is a pin!',
                'htmlUrl' => 'https://this.pin',
                'thumbnailUrl' => 'https://this.gif',
                'createdAt' => 1505434551,
            ],
        ],
        'user' => [
            [
                'id' => 1,
                'username' => 'foo1',
                'password' => 'bar1',
                'createdAt' => 1505434551,
            ],
            [
                'id' => 2,
                'username' => 'foo2',
                'password' => 'bar2',
                'createdAt' => 1505434551,
            ],
        ],
    ];

    public static function factory(string $resourceName)
    {
        return self::$data[strtolower($resourceName)];
    }
}