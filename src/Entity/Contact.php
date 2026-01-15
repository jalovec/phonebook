<?php

declare(strict_types=1);

namespace App\Entity;

use App\Domain\Contact\Enum\PhoneNumberType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    /** @phpstan-ignore-next-line */
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 20, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column(type: Types::STRING, length: 100)]
    #[Assert\NotBlank(message: 'Jméno nesmí být prázdné')]
    private string $firstName;

    #[ORM\Column(type: Types::STRING, length: 100)]
    #[Assert\NotBlank(message: 'Příjmení nesmí být prázdné')]
    private string $lastName;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $position = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank(message: 'Email nesmí být prázdný')]
    private string $email;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank(message: 'Telefonní číslo nesmí být prázdné')]
    private string $phoneNumber;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(enumType: PhoneNumberType::class, options: ['default' => 'mobile'])]
    #[Assert\Choice(
        choices: ['mobile', 'home', 'work', 'other'],
        message: 'Neplatný typ telefonního čísla'
    )]
    private PhoneNumberType $phoneNumberType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): void
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

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): void
    {
        $this->position = $position;
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getPhoneNumberType(): PhoneNumberType
    {
        return $this->phoneNumberType;
    }

    public function setPhoneNumberType(PhoneNumberType $phoneNumberType): void
    {
        $this->phoneNumberType = $phoneNumberType;
    }
}
