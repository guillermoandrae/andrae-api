<?php

namespace Test\Models;


use App\Models\Post;

class PostTest extends \TestCase
{
    /**
     * @var Post
     */
    private $post;

    /**
     * @var array
     */
    private $postData = [
        'id' => 1,
        'externalId' => 2,
        'source' => 'Twitter',
        'originalAuthor' => 'guillermoandrae',
        'body' => 'This is a tweet!',
        'htmlUrl' => 'https://this.tweet',
        'thumbnailUrl' => 'https://this.image',
        'title' => '',
        'slug' => '',
        'summary' => '',
        'description' => '',
        'relativeCreatedAt' => '',
        'action' => '',
    ];

    public function testGetId()
    {
        self::assertEquals($this->postData['id'], $this->post->getId());
    }

    public function testGetExternalId()
    {
        self::assertEquals($this->postData['externalId'], $this->post->getExternalId());
    }

    public function testGetSource()
    {
        self::assertEquals($this->postData['source'], $this->post->getSource());
    }

    public function testGetOriginalAuthor()
    {
        self::assertEquals($this->postData['originalAuthor'], $this->post->getOriginalAuthor());
    }

    public function testGetBody()
    {
        self::assertEquals($this->postData['body'], $this->post->getBody());
    }

    public function testGetHtmlUrl()
    {
        self::assertEquals($this->postData['htmlUrl'], $this->post->getHtmlUrl());
    }

    public function testGetThumbnailUrl()
    {
        self::assertEquals($this->postData['thumbnailUrl'], $this->post->getThumbnailUrl());
    }

    public function testGetCreatedAt()
    {
        self::assertEquals($this->postData['createdAt'], $this->post->getCreatedAt());
    }

    public function testToArray()
    {
        $expectedArray = $this->postData;
        $expectedArray['createdAt'] = $expectedArray['createdAt']->format(DATE_ATOM);
        self::assertEquals($expectedArray, $this->post->toArray());
    }

    public function setUp()
    {
        parent::setUp();
        $this->postData['createdAt'] = new \DateTime('now');
        $this->post = new Post($this->postData);
    }
}
