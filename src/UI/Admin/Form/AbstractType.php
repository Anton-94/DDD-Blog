<?php

declare(strict_types=1);

namespace UI\Admin\Form;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractType extends \Symfony\Component\Form\AbstractType
{
    protected function setAdminTranslation(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', 'Admin');
    }
}

