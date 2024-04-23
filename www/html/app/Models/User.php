<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Contracts\AllowSubscriptionInterface;
use App\Models\Roles\ParentUser;
use App\Models\Roles\PrivateTutor;
use App\Models\Roles\Student;
use App\Models\Roles\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;

class User extends Authenticatable implements AllowSubscriptionInterface
{
    use HasFactory, Notifiable, SingleTableInheritanceTrait;

    protected $table = 'users';

    protected static string $singleTableTypeField = 'role';

    protected static array $singleTableSubclasses = [Student::class, Teacher::class, ParentUser::class, PrivateTutor::class];

    protected $fillable = [
        'first_name',
        'last_name',
        'role',
        'email',
        'subscription',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function subscribe(?string $subscription = null): void
    {
        if (empty($this->id)) {
            throw new \RuntimeException('The user is not initialized');
        }

        $this->subscription = $subscription ?? $this->getDefaultSubscription();
        $this->save();
    }

    public function getDefaultSubscription(): string
    {
        return 'base';
    }
}
