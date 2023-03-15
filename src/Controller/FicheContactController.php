<?php

namespace App\Controller;

use App\Form\ContactType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;

class FicheContactController extends AbstractController
{
    /**
     * @Route("/fiche-contact", name="fiche_contact")
     */
    public function index(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            // Envoi du mail
            $this->sendMail($contact, $mailer);

            $this->addFlash('success', 'Votre message a bien été envoyé.');

            return $this->redirectToRoute('fiche_contact');
        }

        return $this->render('fiche_contact/index.html.twig', [
            'formContact' => $form->createView(),
        ]);
    }

    private function sendMail(Contact $contact, MailerInterface $mailer)
    {
        $message = (new Email())
            ->from($contact->getMail())
            ->to($contact->getDepartement()->getManagerMail())
            ->text(
                'Message de '
                . $contact->getFirstname()
                . ' '
                . $contact->getLastname()
                . ' ('
                . $contact->getMail()
                . ') : '
                . $contact->getMessage()
            );

         $mailer->send($message);
    }
}