<?php

namespace App\Entity;

use App\Repository\GruposRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GruposRepository::class)]
class Grupos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profesor $profesor = null;

    #[ORM\OneToMany(mappedBy: 'grupos', targetEntity: Hijos::class)]
    private Collection $alumnos;

    public function __construct()
    {
        $this->alumnos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProfesor(): ?Profesor
    {
        return $this->profesor;
    }

    public function setProfesor(Profesor $profesor): self
    {
        $this->profesor = $profesor;

        return $this;
    }

    /**
     * @return Collection<int, Hijos>
     */
    public function getAlumnos(): Collection
    {
        return $this->alumnos;
    }

    public function addAlumno(Hijos $alumno): self
    {
        if (!$this->alumnos->contains($alumno)) {
            $this->alumnos->add($alumno);
            $alumno->setGrupos($this);
        }

        return $this;
    }

    public function removeAlumno(Hijos $alumno): self
    {
        if ($this->alumnos->removeElement($alumno)) {
            // set the owning side to null (unless already changed)
            if ($alumno->getGrupos() === $this) {
                $alumno->setGrupos(null);
            }
        }

        return $this;
    }
}
