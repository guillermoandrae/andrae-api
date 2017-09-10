<?php

namespace Test\Http\Controllers;

class ProfileControllerTest extends \TestCase
{
    public function testIndex()
    {
        $response = $this->call('GET', '/profile');
        self::assertEquals(200, $response->status());
        self::assertContains('Breakthrough', $response->content());
    }
}
