<?php


namespace App;


use Mezzio\Application;
use Psr\Container\ContainerInterface;

class RoutesDelegator
{
    /**
     * @param ContainerInterface $container
     * @param $serviceName
     * @param callable $callback
     * @return Application
     */
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        /** @var $app Application*/
        $app = $callback();

        $app->route('/crear-persona[/]', [
            Handler\PersonaHandler::class
        ], ['POST'], 'crear-personas');

        $app->route('/personas[/]', [
            Handler\PersonaHandler::class
        ], ['GET'], 'personas');

        $app->route('/persona/{id:\d+}', [
            Handler\PersonaHandler::class
        ], ['GET'], 'persona');

        $app->route('/eliminar-persona/{id:\d+}', [
            Handler\PersonaHandler::class
        ], ['DELETE'], 'eliminar-persona');

        $app->route('/actualizar-persona/{id:\d+}', [
            Handler\PersonaHandler::class
        ], ['PUT'], 'actualizar-persona');

        return $app;
    }
}
