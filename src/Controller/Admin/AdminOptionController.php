<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Form\OptionType;
use App\Repository\OptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminOptionController extends AbstractController
{
    #[Route('/option', name: 'option_index', methods: ['GET'])]
    public function index(OptionRepository $optionRepository): Response
    {
        return $this->render('admin_property/option/index.html.twig', [
            'options' => $optionRepository->findAll(),
        ]);
    }

    #[Route('/option/new', name: 'option_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $option = new Option();
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($option);
            $entityManager->flush();

            return $this->redirectToRoute('option_index');
        }

        return $this->render('admin_property/option/new.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/option//{id}', name: 'option_show', methods: ['GET'])]
    public function show(Option $option): Response
    {
        return $this->render('admin_property/option/show.html.twig', [
            'option' => $option,
        ]);
    }

    #[Route('/option/{id}/edit', name: 'option_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Option $option): Response
    {
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('option_index');
        }

        return $this->render('admin_property/option/edit.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/option/{id}', name: 'option_delete', methods: ['POST'])]
    public function delete(Request $request, Option $option): Response
    {
        if ($this->isCsrfTokenValid('delete'.$option->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($option);
            $entityManager->flush();
        }

        return $this->redirectToRoute('option_index');
    }
}
