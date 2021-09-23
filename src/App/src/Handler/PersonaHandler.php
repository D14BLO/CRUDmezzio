<?php


namespace App\Handler;

use App\RestDispatchTrait;
use App\Service\PersonaService;
use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\InputFilter\InputFilterInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersonaHandler implements RequestHandlerInterface
{
    use RestDispatchTrait;

    /** @var PersonaService */
    private $personaService;

    /** @var InputFilterInterface*/
    private $inputFilter;

    /** @var InputFilterInterface */
    private $optionalInputs;

    public function __construct(PersonaService $personaService, InputFilterInterface $inputFilter, InputFilterInterface $optionalInputs)
    {
        $this->personaService = $personaService;
        $this->inputFilter = $inputFilter;
        $this->optionalInputs = $optionalInputs;
    }

    public function validData(ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();
        $this->inputFilter->setData($data);
        $this->optionalInputs->setData($data);

        if ($this->inputFilter->isValid()) {
            return $this->inputFilter->getValues();
        }

        $data = [
            'error' => StatusCodeInterface::STATUS_BAD_REQUEST,
            'message' => 'verifique los campos'
        ];
        return new JsonResponse($data, StatusCodeInterface::STATUS_BAD_REQUEST);
    }

    public function post(ServerRequestInterface $request): ResponseInterface
    {
        //Agregar personas
        $persona = $this->validData($request);
        if (!is_array($persona)) {
            return $persona;
        } else {
            $response = $this->personaService->createPersona($persona);
            return new JsonResponse($response);
        }
    }

    public function get(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id', false);
        $persons = false === $id ? $this->personaService->getAllPersons() : $this->personaService->findOneById($id);
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
