<?php

namespace ChatApiSample\Primary\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class GetUserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add(
                'id',
                TextType::class,
                [
                    'label' => 'ユーザーID',
                    'required' => false,
                    'constraints' => [
                        new Assert\NotNull([
                            'message' => 'user.id.not_blank',
                        ]),
                        new Assert\Length([
                            'max' => 10,
                            'maxMessage' => 'user.id.length.max'
                        ]),
                        new Assert\Regex([
                            'pattern' => '/^[0-9]+$/',
                            'message' => 'user.id.regex'
                        ]),
                    ],
                ]
            )
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }

    public function getName()
    {
        return '';
    }

}
