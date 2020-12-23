<?php


namespace App\Factory;

use App\Handler\PersonaHandler;
use App\Service\PersonaService;
use Psr\Container\ContainerInterface;

class PersonaHandlerFactory
{
    public function __invoke(ContainerInterface $container): PersonaHandler
    {
        $personaService = $container->get(PersonaService::class);

        return new PersonaHandler($personaService);
    }
}
