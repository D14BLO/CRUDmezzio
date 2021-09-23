<?php


namespace App\InputFilters;


use Laminas\Filter\StringTrim;
use Laminas\Filter\ToNull;
use Laminas\InputFilter\OptionalInputFilter;

class PersonaOptionalInputFilter extends OptionalInputFilter
{
    public function init()
    {
        $this->add([
            'name' => 'apellido_paterno',
            'required' => false,
            'filters' => [
                ['name' => ToNull::class]
            ],
            'validators' => [],
        ]);

        $this->add([
            'name' => 'apellido_materno',
            'required' => false,
            'filters' => [
                ['name' => StringTrim::class]
            ]
        ]);
    }
}
