<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class SendEmail extends AbstractController
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    
    public function sendEmail($user, $message, $template)
    {
        $email = (new TemplatedEmail())
        ->from('techawayecommerce@gmail.com')
        ->to($user->getEmail())
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject($message)
        // ->text('coucou')
        //->html('<p>Contenu du mail normalement</p>')
        ->htmlTemplate('mailer/'.$template.'.html.twig')
        ->context([
            'user' =>  $user,
        ]);
        //dd( $user); 
        $this->mailer->send($email);
        $this->addFlash('primary', 'Un email de confirmation de commande vous a été envoyé');

    }
}
