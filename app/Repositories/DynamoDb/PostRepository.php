<?php

namespace App\Repositories\DynamoDb;

use App\Helpers\DateHelper;
use App\Helpers\PostHelper;
use App\Models\ModelInterface;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Collection;

class PostRepository extends AbstractRepository implements PostRepositoryInterface
{
    /**
     * @var string
     */
    protected $tableName = 'posts';

    /**
     * @param string $source
     * @param int|null $offset
     * @param int|null $limit
     * @return Collection
     */
    public function findBySource(string $source, int $offset = null, int $limit = null): Collection
    {
        $filters = [
            'source' => [
                'AttributeValueList' => [
                    ['S' => $source]
                ],
                'ComparisonOperator' => 'EQ'
            ]
        ];
        return $this->scan($filters, $offset, $limit);
    }

    /**
     * @param array $data
     * @return ModelInterface
     */
    protected function populate(array $data = null): ModelInterface
    {
        if (!$data) {
            return parent::populate($data);
        }
        return parent::populate(array_merge($data, [
            'relativeCreatedAt' => ['S' => DateHelper::getRelativeTime($data['createdAt']['N'])],
            'action'            => ['S' => PostHelper::getAction($data['id']['S'], $data['htmlUrl']['S'])],
            'summary'           => ['S' => PostHelper::getSummary($data['body']['S'])],
            'title'             => ['S' => PostHelper::getTitle($data['source']['S'], $data['body']['S'])],
            'slug'              => ['S' => PostHelper::getSlug($data['source']['S'], $data['body']['S'])],
            'description'       => ['S' => PostHelper::getDescription($data['body']['S'])],
        ]));
    }

    /**
     * @param string $id
     * @param array $data
     * @return array
     */
    protected function getItemData($id, array $data): array
    {
        return [
            'id'                => ['S' => (string) $id],
            'externalId'        => ['S' => (string) $data['externalId']],
            'source'            => ['S' => $data['source']],
            'originalAuthor'    => ['S' => $data['originalAuthor']],
            'body'              => ['S' => $data['body']],
            'htmlUrl'           => ['S' => $data['htmlUrl']],
            'thumbnailUrl'      => ['S' => $data['thumbnailUrl']],
            'createdAt'         => ['N' => (string) strtotime($data['createdAt'])],
        ];
    }
}
