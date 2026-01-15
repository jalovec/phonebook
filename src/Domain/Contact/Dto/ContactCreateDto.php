<?php

declare(strict_types=1);

namespace App\Domain\Contact\Dto;

use App\Domain\Contact\Enum\AvatarType;
use App\Domain\Contact\Enum\PhoneNumberType;
use Symfony\Component\Validator\Constraints as Assert;

class ContactCreateDto
{
    #[Assert\NotBlank(message: 'Avatar of the contact is required')]
    private AvatarType $avatar;

    #[Assert\NotBlank(message: 'Name of the contact is required')]
    private string $firstName;

    #[Assert\NotBlank(message: 'Surname of the contact is required')]
    private string $lastName;

    #[Assert\NotBlank(message: 'Email of the contact is required')]
    private string $email;

    #[Assert\NotBlank(message: 'Phone number of the contact is required')]
    private string $phoneNumber;

    private PhoneNumberType $phoneNumberType;

    private ?string $address = null;
    private ?string $position = null;

    public function getAvatar(): AvatarType
    {
        return $this->avatar;
    }

    public function setAvatar(AvatarType $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getPhoneNumberType(): PhoneNumberType
    {
        return $this->phoneNumberType;
    }

    public function setPhoneNumberType(PhoneNumberType $phoneNumberType): void
    {
        $this->phoneNumberType = $phoneNumberType;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): void
    {
        $this->position = $position;
    }
}
