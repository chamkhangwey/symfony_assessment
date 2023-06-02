<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhoneBookController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/phonebook', name: 'phonebook')]
    public function index(): Response
    {
        $repository = $this->em->getRepository(Contact::class);
        $contacts = $repository->findBy([], ['lastName' => 'ASC']);

        return $this->render('phone_book/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    #[Route('/phonebook/create', name: 'phonebook_create')]
    public function create(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $new_contact = $form->getData();

            $this->em->persist($new_contact);
            $this->em->flush();

            return $this->redirectToRoute('phonebook');
        }
        return $this->render('phone_book/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
