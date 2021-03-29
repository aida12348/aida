<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Prénom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $motdepasse;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Email;

    /**
     * @ORM\OneToMany(targetEntity=Acces::class, mappedBy="utilisateur", orphanRemoval=true)
     */
    private $Acces;


    public function __construct()
    {
        $this->Acces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrénom(): ?string
    {
        return $this->Prénom;
    }

    public function setPrénom(string $Prénom): self
    {
        $this->Prénom = $Prénom;

        return $this;
    }

    public function getMotdepasse(): ?string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * @return Collection|Acces[]
     */
    public function getAcces(): Collection
    {
        return $this->Acces;
    }

    public function addAcce(Acces $acce): self
    {
        if (!$this->Acces->contains($acce)) {
            $this->Acces[] = $acce;
            $acce->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAcce(Acces $acce): self
    {
        if ($this->Acces->removeElement($acce)) {
            // set the owning side to null (unless already changed)
            if ($acce->getUtilisateur() === $this) {
                $acce->setUtilisateur(null);
            }
        }

        return $this;
    }
}
