<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;
use App\Form\ContactType;
use App\Form\PropertyType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use PharIo\Manifest\Requirement;
use App\Repository\PropertyRepository;
use App\Notification\ContactNotification;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/property')]
class PropertyController extends AbstractController
{

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
        // $this->em = $em;
    }

    #[Route('/', name: 'property')]
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('property/index.html.twig', [
            'properties' => $properties,
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'property.show')]
    public function show(Property $property, Request $request, ContactNotification $notification, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact, $property);
            $this->addFlash(
                'success',
                'Votre message a bien été envoyé'
            );
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId()
            ]);
        }

        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties',
            'form' => $form->createView(),

        ]);
    }
}
