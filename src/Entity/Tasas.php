<?php

namespace App\Entity;

use App\Repository\TasasRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TasasRepository::class)]
class Tasas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $FechaPago = null;

    #[ORM\Column(length: 255)]
    private ?string $cantidad = null;

    #[ORM\Column]
    private ?bool $pagado = null;

    #[ORM\ManyToOne(inversedBy: 'tasas')]
    private ?Hijos $alumno = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaPago(): ?\DateTimeInterface
    {
        return $this->FechaPago;
    }

    public function setFechaPago(\DateTimeInterface $FechaPago): self
    {
        $this->FechaPago = $FechaPago;

        return $this;
    }

    public function getCantidad(): ?string
    {
        return $this->cantidad;
    }

    public function setCantidad(string $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function isPagado(): ?bool
    {
        return $this->pagado;
    }

    public function setPagado(bool $pagado): self
    {
        $this->pagado = $pagado;

        return $this;
    }

    public function getAlumno(): ?Hijos
    {
        return $this->alumno;
    }

    public function setAlumno(?Hijos $alumno): self
    {
        $this->alumno = $alumno;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }
}
