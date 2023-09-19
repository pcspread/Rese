<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        /* ============================================================
        基本的なテストの実施
        [結果]
        202309181700
        OK (1 test, 4 assertions)
        ============================================================ */
        $this->assertTrue(true);

        $array = [];
        $this->assertEmpty($array);

        $txt = 'Hello World';
        $this->assertEquals('Hello World', $txt);

        $n = random_int(0, 100);
        $this->assertLessThan(100, $n);
    }
}
