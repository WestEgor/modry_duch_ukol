<?php

namespace App\Entity;

use App\Repository\KontaktyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KontaktyRepository::class)]
class Kontakty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $celeJmeno;

    #[ORM\Column(type: 'string', length: 25)]
    private $telefonniCislo;

    #[ORM\Column(type: 'string', length: 100)]
    private $email;

    #[ORM\Column(type: 'text')]
    private $poznamka;

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCeleJmeno(): ?string
    {
        return $this->celeJmeno;
    }

    public function setCeleJmeno(string $celeJmeno): self
    {
        $this->celeJmeno = $celeJmeno;

        return $this;
    }

    public function getTelefonniCislo(): ?string
    {
        return $this->telefonniCislo;
    }

    public function setTelefonniCislo(string $telefonniCislo): self
    {
        $this->telefonniCislo = $telefonniCislo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPoznamka(): ?string
    {
        return $this->poznamka;
    }

    public function setPoznamka(string $poznamka): self
    {
        $this->poznamka = $poznamka;

        return $this;
    }
}
