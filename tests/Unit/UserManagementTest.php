<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserManagementTest extends TestCase
{

    #[Test]
    public function a_user_has_a_name()
    {
        $user = User::factory()->create(['name' => 'John Doe']);
        $this->assertEquals('John Doe', $user->name);
    }

    #[Test]
    public function a_user_can_be_updated()
    {
        $user = User::factory()->create(['name' => 'Original Name']);
        $user->update(['name' => 'Updated Name']);
        $this->assertEquals('Updated Name', $user->fresh()->name);
    }

    #[Test]
    public function a_user_can_be_deleted()
    {
        $user = User::factory()->create();
        $userId = $user->id;
        $user->delete();
        $this->assertDatabaseMissing('users', ['id' => $userId]);
    }

    #[Test]
    public function a_user_can_be_created()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123')
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com'
        ]);
    }

    #[Test]
    public function users_email_must_be_unique()
    {
        $user1 = User::factory()->create(['email' => 'test@example.com']);
        $user2 = User::factory()->make(['email' => 'test@example.com']);

        $this->expectException(\Illuminate\Database\QueryException::class);
        $user2->save();
    }
}

