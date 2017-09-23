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
        'title' => 'Twitter - This is a tweet!',
        'slug' => 'this-is-a-tweet',
        'summary' => 'This is a tweet!',
        'description' => 'This is a tweet!',
        'relativeCreatedAt' => '1 day ago',
        'action' => 'Test',
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

    public function testGetRelativeCreatedAt()
    {
        self::assertEquals($this->postData['relativeCreatedAt'], $this->post->getRelativeCreatedAt());
    }

    public function testGetCreatedAt()
    {
        $createdAt = $this->post->getCreatedAt();
        self::assertEquals(new \DateTime(), $createdAt);
    }

    public function testGetSummary()
    {
        self::assertEquals($this->postData['summary'], $this->post->getSummary());
    }

    public function testGetTitle()
    {
        self::assertEquals($this->postData['title'], $this->post->getTitle());
    }

    public function testGetSlug()
    {
        self::assertEquals($this->postData['slug'], $this->post->getSlug());
    }

    public function testGetDescription()
    {
        self::assertEquals($this->postData['description'], $this->post->getDescription());
    }

    public function testGetAction()
    {
        self::assertEquals($this->postData['action'], $this->post->getAction());
    }

    public function testToArray()
    {
        $expectedArray = $this->postData;
        $expectedArray['createdAt'] = null;
        self::assertEquals($expectedArray, $this->post->toArray());
    }

    public function setUp()
    {
        parent::setUp();
        $this->post = new Post($this->postData);
    }
}
