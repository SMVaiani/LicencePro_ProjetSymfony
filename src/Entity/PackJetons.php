<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PackJetonsRepository")
 */
class PackJetons
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Achat", mappedBy="packjetons", orphanRemoval=true)
     */
    private $achat;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbjetons;

    public function __construct()
    {
        $this->achat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection|Achat[]
     */
    public function getAchat(): Collection
    {
        return $this->achat;
    }

    public function addAchat(Achat $achat): self
    {
        if (!$this->achat->contains($achat)) {
            $this->achat[] = $achat;
            $achat->setPackjetons($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achat->contains($achat)) {
            $this->achat->removeElement($achat);
            // set the owning side to null (unless already changed)
            if ($achat->getPackjetons() === $this) {
                $achat->setPackjetons(null);
            }
        }

        return $this;
    }

	public function getNbjetons(): ?int
	{
		return $this->nbjetons;
	}
	
    public function setNbjetons(int $nbjetons): self
    {
        $this->nbjetons = $nbjetons;

        return $this;
    }
	
	public function __toString()
	{
		return $this->description;
	}
}
