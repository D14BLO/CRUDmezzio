<?php


namespace App\InputFilters;

use Laminas\Filter\StringTrim;
use Laminas\InputFilter\InputFilter;

class PersonaInputFilter extends InputFilter
{
    public function init()
    {
        $this->add([
            'name' => 'nombre',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class]
            ],
            'validators' => [],
            'allow_empty' => false,
        ]);
    }
}
