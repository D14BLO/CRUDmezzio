<?php


namespace App\Dao;

use App\Entity\Persona;
use Doctrine\ORM\EntityManager;

class PersonaDao
{
    /** @var EntityManager */
    private $entityManager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    private $repository;

    /**
     * PersonaDao constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Persona::class);
    }

    /**
     * @param Persona $persona
     * @return array
     */
    public function createPerson(Persona $persona)
    {
        try {
            $this->entityManager->beginTransaction();
            $this->entityManager->persist($persona);
            $this->entityManager->flush();
            $this->entityManager->commit();

            return $this->formatPersons($persona);
        } catch (\Exception $exception) {
            error_log($exception->getMessage());
            $this->entityManager->rollback();
        }
    }

    public function findOneById($id)
    {
        $person = $this->repository->findOneBy(["id" => $id]);
        if ($person) {
            $response = $this->formatPersons($person);
        } else {
            $response = "La persona no existe";
        }

        return $response;
    }

    public function getAllPersons(): array
    {
        $persons = $this->repository->findAll();
        foreach ($persons as $person) {
            $response[] = $this->formatPersons($person);
        }
        return $response;
    }

    public function formatPersons(Persona $persona): array
    {
        return [
            "id" => $persona->getId(),
            "nombre" => $persona->getNombre(),
            "apellido_paterno" => $persona->getApellidoPaterno(),
            "apellido_materno" => $persona->getApellidoMaterno()
        ];
    }

    public function deletePerson($id)
    {
        $person = $this->repository->findOneBy(["id" => $id]);

        if ($person) {
            $this->entityManager->remove($person);
            $this->entityManager->flush();
            $response = "La persona" . " " . $id . " " . "se ha eliminado";
        } else {
            $response = "La persona no existe";
        }

        return $response;
    }

    public function updatePerson($id, $data)
    {
        try {
            $person = $this->repository->findOneBy(["id" => $id]);
            if ($person) {
                $person->setNombre($data["nombre"]);
                $person->setApellidoPaterno($data["apellido_paterno"]);
                $person->setApellidoMaterno($data["apellido_materno"]);

                $this->entityManager->beginTransaction();
                $this->entityManager->persist($person);
                $this->entityManager->flush();
                $this->entityManager->commit();

                $response = $this->formatPersons($person);
            } else {
                $response = "La persona no existe";
            }

            return $response;
        } catch (\Exception $exception) {
            error_log($exception->getMessage());
            $this->entityManager->rollback();
        }
    }
}
