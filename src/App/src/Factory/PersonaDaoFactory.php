<?php


namespace App\Factory;

use App\Dao\PersonaDao;
use Interop\Container\ContainerInterface;

class PersonaDaoFactory
{
    public function __invoke(ContainerInterface $container): PersonaDao
    {
        $entityManager = $container->get('doctrine.entity_manager.orm_default');
        return new PersonaDao($entityManager);
    }
}
