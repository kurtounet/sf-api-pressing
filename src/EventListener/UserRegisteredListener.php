<?php
namespace App\EventListener;
use App\Events\UserRegisteredEvent;
use App\Services\EmailNotificationService;
class UserRegisteredListener
{
    public function __construct(
        private EmailNotificationService $emailNotificationService
    ) {}
    public function onUserRegistered(UserRegisteredEvent $event): void
    {
        $user = $event->getUser();
        $this->emailNotificationService->sendConfirmationEmail($user);
    }
}