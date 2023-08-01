<?php

namespace App\Controller;

use App\Form\ContactFormType;
use App\Model\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact_index')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ContactFormType::class, new Contact(), [
            'action' => $this->generateUrl('contact_index'),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('contact_success');
        }

        return $this->render('pages/contact/index.html.twig', [
            'form' => $form
        ]);
    }


    #[Route('/contact/success', name: 'contact_success')]
    public function success(): Response
    {
        return $this->render('pages/contact/success.html.twig');
    }
}