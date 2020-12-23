<?php


namespace App\Factory;


use App\Dao\PersonaDao;
use App\Service\PersonaService;
use Psr\Container\ContainerInterface;

class PersonaServiceFactory
{
    public function __invoke(ContainerInterface $container): PersonaService
    {
        $personaDao = $container->get(PersonaDao::class);
        return new PersonaService($personaDao);
    }
}