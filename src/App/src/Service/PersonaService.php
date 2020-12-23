<?php


namespace App\Service;

use App\Dao\PersonaDao;
use App\Entity\Persona;

class PersonaService
{
    /** @var PersonaDao */
    private $personaDao;

    public function __construct(PersonaDao $personaDao)
    {
        $this->personaDao = $personaDao;
    }

    public function createPersona($data)
    {
        $persona = new Persona();
        $persona->setNombre($data["nombre"]);
        $persona->setApellidoPaterno($data["apellido_paterno"]);
        $persona->setApellidoMaterno($data["apellido_materno"]);

        return $this->personaDao->createPerson($persona);
    }

    public function getAllPersons(): array
    {
        return $this->personaDao->getAllPersons();
    }

    public function findOneById($id)
    {
        return $this->personaDao->findOneById($id);
    }

    public function deletePerson($id)
    {
        return $this->personaDao->deletePerson($id);
    }

    public function updatePerson($id, $data)
    {
        return $this->personaDao->updatePerson($id, $data);
    }
}
