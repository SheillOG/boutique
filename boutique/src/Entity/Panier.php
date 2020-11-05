<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private $montant_total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreation(): ?dateTime
    {
        return $this->date_creation;
    }

    public function setDateCreation(dateTime $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getMontantTotal(): ?string
    {
        return $this->montant_total;
    }

    public function setMontantTotal(string $montant_total): self
    {
        $this->montant_total = $montant_total;

        return $this;
    }
}
