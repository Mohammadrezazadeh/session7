<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of CommentType
 *
 * @author Mohammad
 */
class CommentType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("name")
                ->add("email")
                ->add("comment")
                ;
    }
    public function getName() {
        return "app_comment";;
    }
}
