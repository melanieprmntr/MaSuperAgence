<?php

namespace App\Notification;

use App\Entity\Contact;
use App\Entity\Property;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactNotification extends AbstractController
{
    private $mailer;


    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function notify(Contact $contact, Property $property)
    {
        $message = (new TemplatedEmail())
            ->from('noreply@agence.fr')
            ->to(new Address('contact@agence.fr'))
            ->replyTo($contact->getEmail())
            ->htmlTemplate('emails/contact.html.twig')
            ->context([
                'contact' => $contact,
                'property' => $property
            ]);
        $this->mailer->send($message);

        // return $this->redirectToRoute('property.show');
    }
}
