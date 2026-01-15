<?php

declare(strict_types=1);

namespace App\Domain\Contact\Form;

use App\Domain\Contact\Dto\ContactCreateDto;
use App\Domain\Contact\Enum\AvatarType;
use App\Domain\Contact\Enum\PhoneNumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactCreateTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('avatar', EnumType::class, [
                'class' => AvatarType::class,
                'label' => 'AVATAR',
                'translation_domain' => 'messages',
                'choice_label' => fn (AvatarType $avatar) => $avatar->label(),
                'choice_translation_domain' => 'messages',
                'expanded' => true,   // radio buttons
                'multiple' => false,
                'required' => true,
                'data' => AvatarType::AVATAR_1,
            ])
            ->add('firstName', TextType::class, [
                'translation_domain' => 'messages',
                'label' => 'FIRST_NAME',
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'translation_domain' => 'messages',
                'label' => 'LAST_NAME',
                'required' => true,
            ])
            ->add('position', TextType::class, [
                'translation_domain' => 'messages',
                'label' => 'POSITION',
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'translation_domain' => 'messages',
                'label' => 'EMAIL',
                'required' => true,
            ])
            ->add('address', TextType::class, [
                'translation_domain' => 'messages',
                'label' => 'ADDRESS',
                'required' => false,
            ])
            ->add('phoneNumber', TextType::class, [
                'translation_domain' => 'messages',
                'label' => 'PHONE_NUMBER',
                'required' => true,
            ])
            ->add('phoneNumberType', ChoiceType::class, [
                'choices' => [
                    'Mobil' => PhoneNumberType::MOBILE,
                    'Domácí' => PhoneNumberType::HOME,
                    'Pracovní' => PhoneNumberType::WORK,
                    'Jiné' => PhoneNumberType::OTHER,
                ],
                'expanded' => false, // select box
                'multiple' => false,
                'label' => 'Typ čísla',
                'choice_label' => function (PhoneNumberType $choice) {
                    // můžeme vrátit hezký string pro select
                    return match ($choice) {
                        PhoneNumberType::MOBILE => 'Mobil',
                        PhoneNumberType::HOME => 'Domácí',
                        PhoneNumberType::WORK => 'Pracovní',
                        PhoneNumberType::OTHER => 'Jiné',
                    };
                },
                'choice_value' => function (?PhoneNumberType $choice) {
                    return $choice?->value;
                },
            ])
            ->add('submit', SubmitType::class, [
                'translation_domain' => 'messages',
                'label' => 'SAVE_CONTACT',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => ContactCreateDto::class,
            ]
        );
    }
}
