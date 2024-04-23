<?php

namespace Tests\Feature;

use App\Events\UserCreated;
use App\Models\Roles\ParentUser;
use App\Models\Roles\PrivateTutor;
use App\Models\Roles\Student;
use App\Models\Roles\Teacher;
use App\Notifications\WelcomeNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class WelcomeNotificationTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('roleDataProvider')]
    public function testSuccessfulSendWelcomeNotification(string $userRoleClass): void
    {
        Notification::fake();

        $user = $userRoleClass::factory()->create();

        UserCreated::dispatch($user);

        Notification::assertSentTo(
            $user,
            static function (WelcomeNotification $notification, array $channels) use ($user) {
                return $notification->user->getWelcomeNotification() === $user->getWelcomeNotification();
            }
        );
    }

    public static function roleDataProvider(): array
    {
        return [
            [Student::class],
            [ParentUser::class],
            [Teacher::class],
            [PrivateTutor::class],
        ];
    }
}
