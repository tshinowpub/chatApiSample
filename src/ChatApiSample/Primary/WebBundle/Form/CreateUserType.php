<?php

namespace ChatApiSample\Primary\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateUserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'メールアドレス',
                    'required' => true,
                ]
            )
            ->add(
                'username',
                TextType::class,
                [
                    'label' => 'ログインID',
                    'required' => true,
                ]
            )
            ->add(
                'plainPassword',
                PasswordType::class,
                [
                    'label' => 'パスワード',
                    'required' => true,
                ]
            )
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }

    public function getName()
    {
        return '';
    }

}
