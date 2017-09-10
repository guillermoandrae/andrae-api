<?php

namespace Test\Http\Controllers;

class IndexControllerTest extends \TestCase
{
    public function testIndex()
    {
        $response = $this->call('GET', '/');
        self::assertEquals(302, $response->status());
        self::assertContains('home', $response->content());
    }
}
