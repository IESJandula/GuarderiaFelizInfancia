<?php

namespace App\Entity;

use App\Repository\HijosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HijosRepository::class)]
class Hijos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $apellidos = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaNacimiento = null;

    #[ORM\ManyToOne(inversedBy: 'hijos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'alumnos')]
    private ?Grupos $grupos = null;

    #[ORM\OneToMany(mappedBy: 'alumno', targetEntity: Tasas::class)]
    private Collection $tasas;

    #[ORM\OneToMany(mappedBy: 'hijos', targetEntity: Notificacion::class)]
    private Collection $notificacion;

   

    public function __construct()
    {
        $this->tasas = new ArrayCollection();
        $this->notificacion = new ArrayCollection();
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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getGrupos(): ?Grupos
    {
        return $this->grupos;
    }

    public function setGrupos(?Grupos $grupos): self
    {
        $this->grupos = $grupos;

        return $this;
    }

    /**
     * @return Collection<int, Tasas>
     */
    public function getTasas(): Collection
    {
        return $this->tasas;
    }

    public function addTasa(Tasas $tasa): self
    {
        if (!$this->tasas->contains($tasa)) {
            $this->tasas->add($tasa);
            $tasa->setAlumno($this);
        }

        return $this;
    }

    public function removeTasa(Tasas $tasa): self
    {
        if ($this->tasas->removeElement($tasa)) {
            // set the owning side to null (unless already changed)
            if ($tasa->getAlumno() === $this) {
                $tasa->setAlumno(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Notificacion>
     */
    public function getNotificacion(): Collection
    {
        return $this->notificacion;
    }

    public function addNotificacion(Notificacion $notificacion): self
    {
        if (!$this->notificacion->contains($notificacion)) {
            $this->notificacion->add($notificacion);
            $notificacion->setHijos($this);
        }

        return $this;
    }

    public function removeNotificacion(Notificacion $notificacion): self
    {
        if ($this->notificacion->removeElement($notificacion)) {
            // set the owning side to null (unless already changed)
            if ($notificacion->getHijos() === $this) {
                $notificacion->setHijos(null);
            }
        }

        return $this;
    }

}
