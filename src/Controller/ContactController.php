<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/index', name: 'app_contact')]

    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        // Render the index.html.twig template
        return $this->render('contact/index.html.twig');
    }

    /**
     * @Route("/contact", name="contact_form", methods={"GET"})
     */
    public function showContactForm(): Response
    {
        // Render the contact form template
        return $this->render('contact/form.html.twig');
    }

    /**
     * @Route("/contact", name="submit_contact_form", methods={"POST"})
     */
    public function submitContactForm(Request $request): Response
    {
        // Process the submitted contact form
        // Example: handle form submission, validate data, save to database, etc.

        // Redirect to a success page or render a success message
        return $this->redirectToRoute('contact_form_success');
    }

    /**
     * @Route("/contact/success", name="contact_form_success")
     */
    public function contactFormSuccess(): Response
    {
        // Render a success message template
        return $this->render('contact/success.html.twig');
    }
}
