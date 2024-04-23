<?php

namespace Tests\Feature;

use App\Contracts\UserServiceInterface;
use App\Events\UserCreated;
use App\Models\Roles\ParentUser;
use App\Models\Roles\PrivateTutor;
use App\Models\Roles\Student;
use App\Models\Roles\Teacher;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('roleDataProvider')]
    public function testCreateStudentRoleUser(string $role, string $subscription): void
    {
        $data = [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->email(),
            'role' => $role,
        ];

        Event::fake();

        $this->postJson('/api/users', $data)
            ->assertStatus(201)
            ->assertJson([]);

        Event::assertDispatched(UserCreated::class);

        $this->assertDatabaseHas('users', array_merge($data, ['subscription' => $subscription]));
    }

    public static function roleDataProvider(): array
    {
        return [
            [Student::ROLE, 'base'],
            [ParentUser::ROLE, 'base'],
            [Teacher::ROLE, 'gold'],
            [PrivateTutor::ROLE, 'silver'],
        ];
    }

    public function testValidationException(): void
    {
        $this->postJson('/api/users', [])
            ->assertStatus(422)
            ->assertJson([
                "email" => ["The email field is required."],
                "first_name" => ["The first name field is required."],
                "last_name" => ["The last name field is required."],
                "role" => ["The role field is required."]
            ]);
    }

    public function testResponseWhenExceptionOccur(): void
    {
        $this->instance(
            UserServiceInterface::class,
            Mockery::mock(UserService::class, function (MockInterface $mock) {
                $mock->shouldReceive('store')
                    ->once()
                    ->andThrow(new \Exception());
            })
        );

        $this->postJson('/api/users', [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->email(),
            'role' => Student::ROLE,
        ])
            ->assertStatus(400)
            ->assertJson(['message' => 'Wrong user data']);
    }
}
