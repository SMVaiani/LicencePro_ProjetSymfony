<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoriqueEncheresRepository")
 */
class HistoriqueEncheres
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_enchere;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="historiqueEncheres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Enchere", inversedBy="historiqueEncheres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $enchere;
	
	public function __construct()
	{
		date_default_timezone_set('Europe/Paris');
		$this->date_enchere = new \DateTime('now');
	}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEnchere(): ?\DateTimeInterface
    {
        return $this->date_enchere;
    }

    public function setDateEnchere(\DateTimeInterface $date_enchere): self
    {
        $this->date_enchere = $date_enchere;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getEnchere(): ?Enchere
    {
        return $this->enchere;
    }

    public function setEnchere(?Enchere $enchere): self
    {
        $this->enchere = $enchere;

        return $this;
    }
	
	public function __toString()
	{
		return $this->date_enchere->format('d-m-Y');
	}
}
