<?php

namespace Test\Repositories\DynamoDb;

use App\Helpers\DateHelper;
use App\Repositories\PostRepository;
use Aws\DynamoDb\DynamoDbClient;
use Aws\MockHandler;
use Aws\Result;
use Illuminate\Support\Collection;

class DynamoDbRepositoryTest extends \TestCase
{
    /**
     * @param string $type
     * @dataProvider getTypes
     */
    public function testFindById($type)
    {
        $modelClassName = '\App\Models\\' . $type;
        $dateTime = new \DateTime('midnight');
        $expectedModelData = [
            'id' => 1,
            'externalId' => 2,
            'source' => 'Twitter',
            'originalAuthor' => 'guillermoandrae',
            'body' => 'This is a tweet!',
            'htmlUrl' => 'https://this.tweet',
            'thumbnailUrl' => 'https://this.image',
            'title' => 'Twitter - This is a tweet!',
            'slug' => 'this-is-a-tweet',
            'summary' => 'This is a tweet!',
            'description' => 'This is a tweet!',
            'relativeCreatedAt' => DateHelper::getRelativeTime($dateTime->getTimestamp()),
            'action' => '<a href="/post/1">Here</a> + <a target="_blank" href="https://this.tweet">There</a>',
            'createdAt' => $dateTime,
        ];
        $expectedResult = new $modelClassName($expectedModelData);
        $repository = $this->getRepository($type, [
            'Item' => [
                'id' => ['S' => $expectedModelData['id']],
                'externalId' => ['S' => $expectedModelData['externalId']],
                'originalAuthor' => ['S' => $expectedModelData['originalAuthor']],
                'source' => ['S' => $expectedModelData['source']],
                'htmlUrl' => ['S' => $expectedModelData['htmlUrl']],
                'thumbnailUrl' => ['S' => $expectedModelData['thumbnailUrl']],
                'body' => ['S' => $expectedModelData['body']],
                'createdAt' => ['N' => $expectedModelData['createdAt']->getTimestamp()],
            ]
        ]);
        $result = $repository->findById('1');
        self::assertEquals($expectedResult, $result);
    }

    /**
     * @param string $type
     * @dataProvider getTypes
     */
    public function testSearch($type)
    {
        $modelClassName = '\App\Models\\' . $type;
        $dateTime = new \DateTime();
        $expectedModelData = [
            ['id' => '1', 'createdAt' => $dateTime, 'body' => 'foo', 'source' => 'Twitter', 'htmlUrl' => 'https://foo'],
            ['id' => '2', 'createdAt' => $dateTime, 'body' => 'bar', 'source' => 'Pinterest', 'htmlUrl' => 'https://bar']
        ];
        $expectedResult = new Collection([
            new $modelClassName($expectedModelData[0]),
            new $modelClassName($expectedModelData[1])
        ]);
        $items = [
            [
                'id' => ['S' => $expectedModelData[0]['id']],
                'body' => ['S' => $expectedModelData[0]['body']],
                'htmlUrl' => ['S' => $expectedModelData[0]['htmlUrl']],
                'source' => ['S' => $expectedModelData[0]['source']],
                'createdAt' => ['N' => $expectedModelData[0]['createdAt']->getTimestamp()]
            ],
            [
                'id' => ['S' => $expectedModelData[1]['id']],
                'body' => ['S' => $expectedModelData[1]['body']],
                'htmlUrl' => ['S' => $expectedModelData[1]['htmlUrl']],
                'source' => ['S' => $expectedModelData[1]['source']],
                'createdAt' => ['N' => $expectedModelData[1]['createdAt']->getTimestamp()]
            ]
        ];
        $repository = $this->getRepository($type, [
            'Items' => $items
        ]);
        $result = $repository->search('foo');
        self::assertEquals($expectedResult[0]->getSource(), $result[0]->getSource());
        self::assertEquals($expectedResult[1]->getSource(), $result[1]->getSource());

    }

    public function getTypes()
    {
        return [ ['Post'] ];
    }

    private function getRepository($type, $data)
    {
        $mock = new MockHandler();
        $result = new Result($data);
        $mock->append($result);
        $client = new DynamoDbClient([
            'version' => 'latest',
            'region' => env('AWS_REGION'),
            'handler' => $mock,
        ]);
        $repositoryClassName = sprintf('\App\Repositories\DynamoDb\%sRepository', $type);
        return new $repositoryClassName($client);
    }
}
