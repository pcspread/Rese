<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// Model読込
use App\Models\User;

class DbTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        /* ======================================================================
        DBテストの実施
        [結果]
        202309181717
        OK (1 test, 1 assertion)
        ====================================================================== */
        User::factory()->create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => 'test1111'
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => 'test1111'
        ]);
    }
}
