<?php

namespace App\Controller;

use App\Domain\Contact\Dto\ContactCompleteDto;
use App\Domain\Contact\Dto\ContactCreateDto;
use App\Domain\Contact\Exception\ContactException;
use App\Domain\Contact\Form\ContactCreateTypeForm;
use App\Domain\Contact\Form\ContactUpdateTypeForm;
use App\Domain\Service\ContactService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class PhonebookController extends AbstractController
{
    public function __construct(
        private readonly ContactService      $contactService,
        private readonly TranslatorInterface $translator,
        private int $defaultContactsLimit = 8,
    ) {
    }

    #[Route(path: '/', name: 'index_route')]
    public function index(
        Request $request,
    ): Response {
        $page = $request->query->getInt('page', 1);
        $limit = $this->defaultContactsLimit;
        $contacts = $this->contactService->getPaginatedContacts($page, $limit);
        $contactsCount = $this->contactService->contactsCount();
        $totalPages = (int) ceil($contactsCount / $limit);

        return $this->render(
            'content/content.html.twig',
            [
                'contacts' => $contacts,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'limit' => $limit,
                'contactsCount' => $contactsCount,
            ]
        );
    }

    #[Route(path: '/create', name: 'create_route')]
    public function create(
        Request $request,
    ): Response {
        $createForm = $this->createForm(ContactCreateTypeForm::class);
        $createForm->handleRequest($request);

        if ($createForm->isSubmitted() && $createForm->isValid()) {
            try {
                /* @var ContactCreateDto $newContact */
                $newContactDto = $createForm->getData();
                $this->contactService->createContact($newContactDto);
                $this->addFlash('success', $this->translator->trans('CONTACT_CREATED_SUCCESS'));

                return $this->redirectToRoute('index_route');
            } catch (\Exception) {
                $this->addFlash('error', $this->translator->trans('CONTACT_CREATION_FAILED'));
            }
        }

        return $this->render(
            'pages/create.html.twig',
            [
                'createForm' => $createForm,
            ]
        );
    }

    #[Route(path: '/update/{id}', name: 'update_route')]
    public function update(
        Request $request,
        int $id,
    ): Response {
        try {
            $contactDto = $this->contactService->getContactById($id);
        } catch (ContactException) {
            $this->addFlash('error', $this->translator->trans('CONTACT_NOT_FOUND'));

            return $this->redirectToRoute('index_route');
        }

        $updateForm = $this->createForm(
            ContactUpdateTypeForm::class,
            $contactDto,
            [
                'action' => $this->generateUrl('update_route', ['id' => $id]),
            ]
        );
        $updateForm->handleRequest($request);

        if ($updateForm->isSubmitted() && $updateForm->isValid()) {
            try {
                /* @var ContactCompleteDto $updatedContact */
                $updatedContact = $updateForm->getData();
                $this->contactService->updateContact($id, $updatedContact);
                $this->addFlash('success', $this->translator->trans('CONTACT_ACTUALIZED_SUCCESS'));

                return $this->redirectToRoute('index_route');
            } catch (\Exception) {
                $this->addFlash('error', $this->translator->trans('CONTACT_ACTUALIZATION_FAILED'));
            }
        }

        return $this->render('pages/create.html.twig', [
            'createForm' => $updateForm->createView(),
        ]);
    }

    #[Route(path: '/delete/{id}', name: 'delete_route')]
    public function delete(
        Request $request,
        int $id,
    ): Response {
        $redirectTo = $request->get('redirectTo');

        try {
            $this->contactService->deleteContact($id);
            $this->addFlash('success', $this->translator->trans('CONTACT_DELETED_SUCCESS'));
        } catch (ContactException $e) {
            $this->addFlash('error', $this->translator->trans('CONTACT_DELETION_FAILED'));
        }

        return $this->redirect(
            $redirectTo ?? $this->generateUrl('index_route')
        );
    }
}
