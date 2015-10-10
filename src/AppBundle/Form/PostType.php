<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of PostType
 *
 * @author Mohammad
 */
class PostType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("title")
                ->add("content")
                ->getForm();
    }
    public function getName() {
        return "app_post";;
    }
}
