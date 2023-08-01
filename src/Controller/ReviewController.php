<?php

namespace App\Controller;

use App\Form\ReviewFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    #[Route('/review', name: 'review_index')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ReviewFormType::class, null);

        $form->handleRequest($request);

        $isSuccessful = false;
        if ($form->isSubmitted() && $form->isValid()) {
            $isSuccessful = true;
        }

        return $this->render('pages/review/index.html.twig', [
            'form' => $form,
            'isSuccessful' => $isSuccessful,
        ]);
    }
}