<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerController extends AbstractController
{
    /**
     * @Route("/email", name="email")
     */
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
        ->from('techawayecommerce@gmail.com')
        ->to('frdric.guillon@gmail.com')
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject('Tech a Way : le meilleur site')
        ->text('coucou')
        ->html('<p>Contenu du mail normalement</p>');

        $mailer->send($email);
        $this->addFlash('primary', 'Un email de confirmation de commande vous a été envoyé');

        return $this->redirectToRoute('home', [], 301);



    }
}
