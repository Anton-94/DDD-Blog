<?php

declare(strict_types=1);

namespace UI\Admin\Form\User;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UI\Admin\Form\AbstractType;

class SignInType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('_username', EmailType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email'
                ],
                'data' => $options['last_email']
            ])
            ->add('_password', PasswordType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Password'
                ]
            ])
            ->add('_remember_me', CheckboxType::class, [
                'label' => 'Remember me',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $this->setAdminTranslation($resolver);

        $resolver->setDefined('last_email');
        $resolver->setDefaults([
            'csrf_token_id' => 'authenticate',
            'csrf_field_name' => '_csrf_token'
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}

