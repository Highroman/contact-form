<?php

namespace App\Controller\Api;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/contacts")
 */
class ApiContactController extends AbstractController
{
    /**
     * @Route("/", name="get_contacts", methods={"GET"})
     */
    public function getContacts(EntityManagerInterface $entityManager): JsonResponse
    {
        $contacts = $entityManager->getRepository(Contact::class)->findAll();

        $response = [];
        foreach ($contacts as $contact) {
            $response[] = [
                'id' => $contact->getId(),
                'first_name' => $contact->getFirstName(),
                'last_name' => $contact->getLastName(),
                'email' => $contact->getEmail(),
                'message' => $contact->getMessage(),
                'department' => $contact->getDepartment()->getName(),
            ];
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/{id}", name="get_contact", methods={"GET"})
     */
    public function getContact(Contact $contact): JsonResponse
    {
        $response = [
            'id' => $contact->getId(),
            'first_name' => $contact->getFirstName(),
            'last_name' => $contact->getLastName(),
            'email' => $contact->getEmail(),
            'message' => $contact->getMessage(),
            'department' => $contact->getDepartment()->getName(),
        ];

        return new JsonResponse($response);
    }

    /**
     * @Route("/", name="create_contact", methods={"POST"})
     */
    public function createContact(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            return new JsonResponse(['message' => 'Contact created'], Response::HTTP_CREATED);
        }

        return new JsonResponse(['message' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/{id}", name="update_contact", methods={"PUT"})
     */
    public function updateContact(Contact $contact, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(ContactType::class, $contact);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return new JsonResponse(['message' => 'Contact updated'], Response::HTTP_OK);
        }

        return new JsonResponse(['message' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/{id}", name="delete_contact", methods={"DELETE"})
     */
    public function deleteContact(Contact $contact, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($contact);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Contact deleted'], Response::HTTP_OK);
    }
}