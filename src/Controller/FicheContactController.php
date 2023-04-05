<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class FicheContactController extends AbstractController
{
    /**
     * @Route("/fiche-contact", name="fiche_contact", methods={"GET"})
     */


    /**
     * @Route("/api/contacts", name="api_create_contact", methods={"POST"})
     */
    public function submitApi(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager): JsonResponse
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            // Envoi du mail
            $this->sendMail($contact, $mailer);

            return new JsonResponse(['message' => 'Votre message a bien été envoyé.'], Response::HTTP_OK);
        }

        return new JsonResponse(['message' => 'Échec de l\'envoi du message.'], Response::HTTP_BAD_REQUEST);
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