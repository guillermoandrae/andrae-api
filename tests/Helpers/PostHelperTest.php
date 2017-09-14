<?php

namespace Test\Helpers;

use App\Helpers\PostHelper;
use App\Models\Post;

class PostHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSummary()
    {
        $body = 'Neque porro quisquam est qui dolorem ipsum quia dolor sit '
            . 'amet, consectetur, adipisci velit';
        self::assertSame(
            PostHelper::TRUNCATED_SUMMARY_LENGTH + 3,
            strlen(PostHelper::getSummary($body))
        );
    }

    public function testGetTitle()
    {
        $source = Post::SOURCE_INSTAGRAM;
        $body = 'This is a post';
        self::assertSame(
            sprintf('%s - %s', $source, $body),
            PostHelper::getTitle($source, $body)
        );
    }

    public function testGetTitleBadSource()
    {
        $body = 'This is a post';
        self::assertNull(PostHelper::getTitle('foo', $body));
    }
}
