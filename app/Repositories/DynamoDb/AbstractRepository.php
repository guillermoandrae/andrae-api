<?php

namespace App\Repositories\DynamoDb;

use App\Models\ModelInterface;
use App\Repositories\RepositoryInterface;
use Aws\DynamoDb\DynamoDbClient;
use ICanBoogie\Inflector;
use Illuminate\Support\Collection;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var DynamoDbClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $tableName;

    /**
     * @param DynamoDbClient $client
     */
    final public function __construct(DynamoDbClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $phrase
     * @param int|null $offset
     * @param int|null $limit
     * @return Collection
     */
    public function search(string $phrase, int $offset = null, int $limit = null): Collection
    {
        $filters = [
            'body' => [
                'AttributeValueList' => [
                    ['S' => $phrase]
                ],
                'ComparisonOperator' => 'CONTAINS'
            ]
        ];
        return $this->scan($filters, $offset, $limit);
    }

    /**
     * @param string $id
     * @return ModelInterface
     */
    public function findById(string $id): ModelInterface
    {
        $conditions = [
            'ConsistentRead' => true,
            'TableName' => $this->tableName,
            'Key' => [
                'id' => ['S' => $id]
            ]
        ];
        $response = $this->client->getItem($conditions);
        return $this->populate($response['Item']);
    }

    /**
     * @return ModelInterface
     */
    public function findLatest(): ModelInterface
    {
        return $this->findAll(0, 1)->first();
    }

    /**
     * @param \DateTime $sinceDateTime
     * @param int|null $offset
     * @param int|null $limit
     * @return Collection
     */
    public function findSince(\DateTime $sinceDateTime, int $offset = null, int $limit = null): Collection
    {
        $filters = [
            'createdAt' => [
                'AttributeValueList' => [
                    ['N' => $sinceDateTime->getTimestamp()]
                ],
                'ComparisonOperator' => 'GT'
            ]
        ];
        return $this->scan($filters, $offset, $limit);
    }

    /**
     * @param int|null $offset
     * @param int|null $limit
     * @return Collection
     */
    public function findAll(int $offset = null, int $limit = null): Collection
    {
        return $this->scan(null, $offset, $limit);
    }

    /**
     * @param array $data
     * @return ModelInterface
     */
    public function create(array $data): ModelInterface
    {
        $id = time();
        $response = $this->client->putItem(
            [
                'TableName' => $this->tableName,
                'Item' => $this->getItemData($id, $data)
            ]
        );
        $statusCode = $response->toArray()['@metadata']['statusCode'];
        if (200 === $statusCode) {
            return $this->findById($id);
        }
    }

    /**
     * @param int $id
     * @return \Aws\Result
     */
    public function delete(int $id)
    {
        $response = $this->client->deleteItem([
            'TableName' => $this->tableName,
            'Key' => [
                'id'  => ['S' => $id],
            ]
        ]);
        return $response;
    }

    /**
     * @param array|null $filters
     * @param int|null $offset
     * @param int|null $limit
     * @return Collection
     */
    protected function scan(array $filters = null, int $offset = null, int $limit = null): Collection
    {
        $items = new Collection();
        $options = ['TableName' => $this->tableName];
        if ($filters) {
            $options['ScanFilter'] = $filters;
        }
        if (!$iterator = $this->client->getIterator('Scan', $options)) {
            return $items;
        }
        foreach ($iterator as $item) {
            $items[] = $this->populate($item);
        }
        return $items->sortByDesc(function (ModelInterface $item) {
            return $item->getCreatedAt()->getTimestamp();
        })->slice($offset, $limit);
    }

    /**
     * @param array|null $data
     * @return ModelInterface
     */
    protected function populate(array $data = null): ModelInterface
    {
        $itemData = [];
        if ($data) {
            foreach ($data as $key => $value) {
                if ($key == 'createdAt') {
                    $dateTime = new \DateTime();
                    $itemData[$key] = $dateTime->setTimestamp($value['N']);
                } else {
                    $itemData[$key] = $value['S'];
                }
            }
        }

        $modelClassName = '\App\Models\\' . ucfirst(Inflector::get()->singularize($this->tableName));
        return new $modelClassName($itemData);
    }

    /**
     * @param string $id
     * @param array $data
     * @return array
     */
    abstract protected function getItemData($id, array $data): array;
}
