<?php

namespace Tests\Feature;

use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_home_page_respond()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
