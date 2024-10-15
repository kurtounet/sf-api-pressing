<?php
namespace App\Services;
use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
class EmailNotificationService
{
    public function __construct(
        private MailerInterface $mailer,
        private string $adminEmail
    ) {
    }
    public function sendConfirmationEmail(
        User $user
    ): void {
        $email = (new Email())
            ->from($this->adminEmail)
            ->to($user->getEmail())
            ->subject('Bienvenu chez Pressing Prestige')
            ->text('Votre email ' . $user->getEmail() .
                ' a bien été enregistré, merci');
        //Envoyer l'email à mailtrap.io 
        $this->mailer->send($email);
    }
}