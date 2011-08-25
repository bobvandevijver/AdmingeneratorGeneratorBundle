<?php

namespace Admingenerator\GeneratorBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;


class DateRangeType extends AbstractType
{
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
         unset($options['years']);
         
         $options['from']['required'] = $options['required'];
         $options['to']['required'] = $options['required'];
         
         $builder
               ->add('from', new DateType(), $options['from'])
               ->add('to', new DateType(), $options['to']);
    }
    
    public function getParent(array $options)
    {
        return 'form';
    }
    
    public function getDefaultOptions(array $options)
    {
        $defaultOptions = array(
            'years'             => range(date('Y'), date('Y') - 120),
            'to'                => null,
            'from'              => null,
        );

        $options = array_replace($defaultOptions, $options);

        if (is_null($defaultOptions['to'])) {
            $defaultOptions['to'] = array('years' => $defaultOptions['years']);
        }
        
        if (is_null($defaultOptions['from'])) {
            $defaultOptions['from'] = array('years' => $defaultOptions['years']);
        } 
        
        return $defaultOptions;
    }
    
    public function getName()
    {
        return 'date_range';
    }
}