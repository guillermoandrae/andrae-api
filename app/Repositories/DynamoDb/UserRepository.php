<?php

namespace App\Repositories\DynamoDb;

use App\Repositories\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $tableName = 'users';

    public function findByUsernameAndPassword(string $username, string $password)
    {
        $filters = [
            'username' => [
                'AttributeValueList' => [
                    ['S' => $username]
                ],
                'ComparisonOperator' => 'EQ'
            ],
            'password' => [
                'AttributeValueList' => [
                    ['S' => $password]
                ],
                'ComparisonOperator' => 'EQ'
            ],
        ];
        if ($users = $this->scan($filters)) {
            return $users->first();
        }
    }

    public function getItemData($id, array $data): array
    {
        return [
            'id'        => ['S' => (string) $id],
            'username'  => ['S' => (string) $data['username']],
            'password'  => ['S' => $data['password']],
            'createdAt' => ['N' => (string) strtotime($data['createdAt'])],
        ];
    }
}
