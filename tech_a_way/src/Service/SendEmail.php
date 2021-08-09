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

    
    public function sendEmail($user, $subjectMessage, $template, $flashMessage, $other1 = null, $other2 = null )
    {


        $email = (new TemplatedEmail())
        ->from('techawayecommerce@gmail.com')
        ->to($user->getEmail())
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject($subjectMessage)
        // ->text('coucou')
        //->html('<p>Contenu du mail normalement</p>')
        ->htmlTemplate('email/'.$template.'.html.twig')
        ->context([
            'user' =>  $user,
            'order' => $other1,
            'total' => $other2
        ]);
        //dd( $user); 
        $this->mailer->send($email);
        $this->addFlash('primary', 'un email ' . $flashMessage . ' vous a été envoyé');

    }
}
