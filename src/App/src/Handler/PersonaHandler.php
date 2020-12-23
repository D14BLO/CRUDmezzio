<?php


namespace App\Handler;

use App\RestDispatchTrait;
use App\Service\PersonaService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersonaHandler implements RequestHandlerInterface
{
    use RestDispatchTrait;
    /** @var PersonaService */
    private $personaService;

    public function __construct(PersonaService $personaService)
    {
        $this->personaService = $personaService;
    }

    public function post(ServerRequestInterface $request): ResponseInterface
    {
        //Agregar personas
        $data = json_decode(file_get_contents('php://input'), true);
        $persona = [
            "nombre" => $data["nombre"],
            "apellido_paterno" => $data["apellido_paterno"],
            "apellido_materno" => $data["apellido_materno"]
        ];
        $response = $this->personaService->createPersona($persona);

        return new JsonResponse($response);
    }

    public function get(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getUri()->getPath() == '/personas') {
            //Obtener todas las personas
            $persons = $this->personaService->getAllPersons();
        } else {
            //Obtener personas por ID
            $id = $request->getAttribute('id', false);
            $persons = $this->personaService->findOneById($id);
        }
        return new JsonResponse($persons);
    }

    public function delete(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id', false);
        $person = $this->personaService->deletePerson($id);
        return new JsonResponse($person);
    }

    public function put(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id', false);
        $data = json_decode(file_get_contents('php://input'), true);
        $response = $this->personaService->updatePerson($id, $data);

        return new JsonResponse($response);
    }
}
