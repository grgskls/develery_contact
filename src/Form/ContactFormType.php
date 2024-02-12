<?php

namespace App\Form;

use App\DTO\ContactFormDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Valid;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Neved',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Hiba! Kérjük töltsd ki az összes mezőt!',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Add meg a neved',
                ],
            ])
            ->add('email', TextType::class, [
                'label' => 'E-mail címed',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Hiba! Kérjük töltsd ki az összes mezőt!',
                    ]),
                    new Email([
                        'message' => 'Hiba! Kérjük érvényes e-mail címet adjál meg!',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Add meg az e-mail címed',
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Üzenet szövege',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Hiba! Kérjük töltsd ki az összes mezőt!',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Írd ide az üzeneted...',
                ],
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Küldés',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactFormDTO::class,
        ]);
    }
}
