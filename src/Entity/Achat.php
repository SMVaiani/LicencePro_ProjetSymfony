<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AchatRepository") 
 */
class Achat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_achat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="achat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PackJetons", inversedBy="achat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $packjetons;

	public function __construct()
	{
		date_default_timezone_set('Europe/Paris');
		$this->date_achat = new \DateTime('now');
	}
	
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->date_achat;
    }

    public function setDateAchat(\DateTimeInterface $date_achat): self
    {
        $this->date_achat = $date_achat;

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

    public function getPackjetons(): ?packJetons
    {
        return $this->packjetons;
    }

    public function setPackjetons(?packJetons $packjetons): self
    {
        $this->packjetons = $packjetons;

        return $this;
    }
	
	public function __toString()
	{
		return $this->getDateAchat()->format('d-m-Y');
	}
}
