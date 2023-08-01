<?php

namespace App\Form;

use App\Model\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    const TOPICS = [
        'Website Feedback',
        'Product Support',
        'Partnership Opportunities',
    ];

    const REASONS = [
        'Website Feedback' => [
            'Report broken links or errors',
            'Provide suggestions for improvement',
            'Compliment the user experience',
            'Suggest new features or functionality',
            'Comment on the website design and layout'
        ],
        'Product Support' => [
            'Ask questions about product features',
            'Report issues or bugs with the product'
        ],
        'Partnership Opportunities' => [
            'Propose a collaboration or joint venture',
            'Request information on becoming a partner',
            'Express interest in co-marketing initiatives',
            'Discuss potential cross-promotional campaigns'
        ],
    ];

    private FormFactoryInterface $factory;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->factory = $builder->getFormFactory();

        $builder
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('topic', ChoiceType::class, [
                'placeholder' => '',
                'choices' => array_combine(self::TOPICS, self::TOPICS)
            ])
            ->add('save', SubmitType::class)
        ;

        $builder->get('topic')->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmitTopic']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }

    public function onPostSubmitTopic(FormEvent $event): void
    {
        $this->addReasonField(
            $event->getForm()->getParent(),
            $event->getForm()->getData()
        );
    }

    public function onPostSubmitReason(FormEvent $event): void
    {
        if($event->getForm()->getData() === null) {
            return;
        }

        $this->addBodyField($event->getForm()->getParent());
    }

    public function addReasonField(FormInterface $form, ?string $topic): void
    {
        if (!$topic) {
            return;
        }

        $reasonFormType = $this->factory
            ->createNamedBuilder('reason', ChoiceType::class, null, [
                'placeholder' => '',
                'choices' => array_combine(self::REASONS[$topic], self::REASONS[$topic]),
                #'invalid_message' => false,
                'auto_initialize' => false,
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmitReason']);

        $form->add($reasonFormType->getForm());
    }

    public function addBodyField(FormInterface $form): void
    {
        $form->add('body', TextareaType::class);
    }
}