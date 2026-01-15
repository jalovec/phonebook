<?php

declare(strict_types=1);

namespace App\Domain\Contact\Service;

use App\Domain\Contact\Dto\ContactCompleteDto;
use App\Domain\Contact\Dto\ContactCreateDto;
use App\Domain\Contact\Exception\ContactException;
use App\Domain\Contact\Repository\ContactRepository;
use App\Entity\Contact;

class ContactService
{
    public const DEFAULT_CONTACT_LIST = 10;
    public function __construct(
        private readonly ContactRepository $contactRepository,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function createContact(ContactCreateDto $contactData): void
    {
        $contact = new Contact();
        $this->fillContact($contact, $contactData);
    }

    /**
     * @return ContactCompleteDto[]
     */
    public function getAllContacts(): array
    {
        $contacts = $this->contactRepository->findAll();

        return array_map(fn ($c) => ContactCompleteDto::createFromEntity($c), $contacts);
    }

    /**
     * @return ContactCompleteDto[]
     */
    public function getPaginatedContacts(int $page = 1, int $limit = 10): array
    {
        $contacts = $this->contactRepository->findPaginated($page, $limit);

        return array_map(fn ($c) => ContactCompleteDto::createFromEntity($c), $contacts);
    }

    /**
     * @throws ContactException
     */
    public function getContactById(int $id): ContactCompleteDto
    {
        $contact = $this->contactRepository->doFind($id);

        return ContactCompleteDto::createFromEntity($contact);
    }

    /**
     * @throws ContactException
     * @throws \Exception
     */
    public function updateContact(int $id, ContactCompleteDto $updatedContact): void
    {
        $contact = $this->contactRepository->doFind($id);
        $this->fillContact($contact, $updatedContact);
    }

    /**
     * @throws \Exception
     */
    private function fillContact(Contact $contact, ContactCompleteDto|ContactCreateDto $contactData): void
    {
        $contact->setFirstName($contactData->getFirstName());
        $contact->setLastName($contactData->getLastName());
        $contact->setEmail($contactData->getEmail());
        $contact->setPhoneNumber($contactData->getPhoneNumber());
        $contact->setPhoneNumberType($contactData->getPhoneNumberType());
        $contact->setAvatar($contactData->getAvatar()->value);

        if (null !== $contactData->getPosition()) {
            $contact->setPosition($contactData->getPosition());
        }

        if (null !== $contactData->getAddress()) {
            $contact->setAddress($contactData->getAddress());
        }

        $this->contactRepository->save($contact, true);
    }

    /**
     * @throws ContactException
     */
    public function deleteContact(int $id): void
    {
        $contact = $this->contactRepository->doFind($id);
        $this->contactRepository->remove($contact, true);
    }

    public function contactsCount(): int
    {
        return $this->contactRepository->count();
    }
}
