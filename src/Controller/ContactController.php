<?php

namespace App\Controller;

use App\DTO\ContactFormDTO;
use App\Entity\ContactQuestion;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        $contactDTO = new ContactFormDTO();
        $form = $this->createForm(ContactFormType::class, $contactDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //$entityManager = $this->getDoctrine()->getManager();

            $contact = new ContactQuestion();
            $contact->setName($contactDTO->name);
            $contact->setEmail($contactDTO->email);
            $contact->setMessage($contactDTO->message);

            $entityManager->persist($contact);
            $entityManager->flush();

            $contactDTO = new ContactFormDTO();
            $form = $this->createForm(ContactFormType::class, $contactDTO);

            return $this->render('contact/form.html.twig', [
                'form' => $form->createView(),
                'successMessage' => 'Köszönjük szépen a kérdésedet. Válaszunkkal hamarosan keresünk a megadott e-mail címen.'
            ]);
        }

        

        return $this->render('contact/form.html.twig', [
            'form' => $form->createView(),
        ]);
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
    public function submitContactForm(EntityManagerInterface $entityManager): Response
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
