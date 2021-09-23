<?php


namespace App\Factory;

use App\Handler\PersonaHandler;
use App\InputFilters\PersonaInputFilter;
use App\InputFilters\PersonaOptionalInputFilter;
use App\Service\PersonaService;
use Laminas\InputFilter\InputFilterPluginManager;
use Psr\Container\ContainerInterface;

class PersonaHandlerFactory
{
    public function __invoke(ContainerInterface $container): PersonaHandler
    {
        $personaService = $container->get(PersonaService::class);

        $pluginManager = $container->get(InputFilterPluginManager::class);
        $inputFilter = $pluginManager->get(PersonaInputFilter::class);
        $optionalInputFilter = $pluginManager->get(PersonaOptionalInputFilter::class);

        return new PersonaHandler($personaService, $inputFilter, $optionalInputFilter);
    }
}
