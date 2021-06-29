<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/')]
class AdminPropertyController extends AbstractController
{
    #[Route('/admin', name: 'admin_property')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $properties = $em->getRepository(Property::class)->findAll();
        return $this->render('admin_property/index.html.twig', [
            'properties' => $properties,
        ]);
    }

    #[Route('/admin/create', name: 'admin_property.create')]
    public function create(Request $request)
    {

        $property = new Property();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($property);
            $em->flush();
            $this->addFlash('success', 'Annonce enregistrées avec succès');
            return $this->redirectToRoute('admin_property');
        }

        return $this->render('admin_property/create.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/{id}', name: 'admin_property.edit', methods: ['GET', 'POST'])]
    public function edit(Property $property, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Les modifications ont été enregistrées avec succès');
            return $this->redirectToRoute('admin_property');
        }

        return $this->render('admin_property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/property/{id}', name: 'admin_property.delete')]
    public function delete(Property $property, Request $request)
    {

        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($property);
            $em->flush();
            $this->addFlash('success', 'Les modifications ont été enregistrées avec succès');
    
        }
        return $this->redirectToRoute('admin_property');
       
    }
}
