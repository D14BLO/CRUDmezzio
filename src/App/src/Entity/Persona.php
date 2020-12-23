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
     * @var string
     * @ORM\Column(name="nombre", type="string", length=20, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     * @ORM\Column(name="apellido_paterno", type="string", length=20, nullable=false)
     */
    private $apellido_paterno;

    /**
     * @var string
     * @ORM\Column(name="apellido_materno", type="string", length=20, nullable=false)
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
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getApellidoPaterno(): string
    {
        return $this->apellido_paterno;
    }

    /**
     * @param string $apellido_paterno
     */
    public function setApellidoPaterno(string $apellido_paterno): void
    {
        $this->apellido_paterno = $apellido_paterno;
    }

    /**
     * @return string
     */
    public function getApellidoMaterno(): string
    {
        return $this->apellido_materno;
    }

    /**
     * @param string $apellido_materno
     */
    public function setApellidoMaterno(string $apellido_materno): void
    {
        $this->apellido_materno = $apellido_materno;
    }
}
