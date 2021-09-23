<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Persona")
 */
class Persona
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=20, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(name="apellido_paterno", type="string", length=20, nullable=true)
     */
    private $apellido_paterno;

    /**
     * @ORM\Column(name="apellido_materno", type="string", length=20, nullable=true)
     */
    private $apellido_materno;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellidoPaterno()
    {
        return $this->apellido_paterno;
    }

    /**
     * @param mixed $apellido_paterno
     */
    public function setApellidoPaterno($apellido_paterno): void
    {
        $this->apellido_paterno = $apellido_paterno;
    }

    /**
     * @return mixed
     */
    public function getApellidoMaterno()
    {
        return $this->apellido_materno;
    }

    /**
     * @param mixed $apellido_materno
     */
    public function setApellidoMaterno($apellido_materno): void
    {
        $this->apellido_materno = $apellido_materno;
    }
}
