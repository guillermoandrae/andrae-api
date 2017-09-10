<?php

namespace Test\Models;


use App\Models\User;

class UserTest extends \TestCase
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var array
     */
    private $userData = [
        'id' => 1,
        'username' => 'foo',
        'password' => 'bar',
    ];

    public function testGetId()
    {
        self::assertEquals($this->userData['id'], $this->user->getId());
    }

    public function testGetUsername()
    {
        self::assertEquals($this->userData['username'], $this->user->getUsername());
    }

    public function testGetPassword()
    {
        self::assertEquals($this->userData['password'], $this->user->getPassword());
    }

    public function testGetCreatedAt()
    {
        self::assertEquals($this->userData['createdAt'], $this->user->getCreatedAt());
    }

    public function testToArray()
    {
        $expectedArray = $this->userData;
        $expectedArray['createdAt'] = $expectedArray['createdAt']->format(DATE_ATOM);
        self::assertEquals($expectedArray, $this->user->toArray());
    }

    public function setUp()
    {
        parent::setUp();
        $this->userData['createdAt'] = new \DateTime('now');
        $this->user = new User($this->userData);
    }
}
