<?php

namespace App\Entity;

use App\Repository\KontaktyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KontaktyRepository::class)]
class Kontakty
{
    /**
     * @var int $id
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * Jméno a příjmení kontaktu
     * @var string $celeJmeno
     */
    #[ORM\Column(type: 'string', length: 100)]
    private string $celeJmeno;

    /**
     * Telefonní číslo kontaktu
     * Musí být unikatním
     * @var string $telefonniCislo
     */
    #[ORM\Column(type: 'string', length: 25, unique: true)]
    private $telefonniCislo;

    /**
     * Email kontaktu
     * @var string $email
     */
    #[ORM\Column(type: 'string', length: 100)]
    private string $email;

    /**
     * Dlouhá poznámka ke kontaktu
     * @var string $poznamka
     */
    #[ORM\Column(type: 'text')]
    private string $poznamka;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getCeleJmeno(): ?string
    {
        return $this->celeJmeno;
    }

    /**
     * @param string $celeJmeno
     * @return $this
     */
    public function setCeleJmeno(string $celeJmeno): self
    {
        $this->celeJmeno = $celeJmeno;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelefonniCislo(): ?string
    {
        return $this->telefonniCislo;
    }

    /**
     * @param string $telefonniCislo
     * @return $this
     */
    public function setTelefonniCislo(string $telefonniCislo): self
    {
        $this->telefonniCislo = $telefonniCislo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPoznamka(): ?string
    {
        return $this->poznamka;
    }

    /**
     * @param string $poznamka
     * @return $this
     */
    public function setPoznamka(string $poznamka): self
    {
        $this->poznamka = $poznamka;

        return $this;
    }
}
