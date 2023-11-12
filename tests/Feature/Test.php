<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_passport_service_form()
    {
        $response = $this->get('certificates');

        $response->assertStatus(302);
    }
}
