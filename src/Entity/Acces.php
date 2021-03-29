<?php

namespace App\Entity;

use App\Repository\AccesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccesRepository::class)
 */
class Acces
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $utilisateurid;

    /**
     * @ORM\Column(type="integer")
     */
    private $autorisationid;

    /**
     * @ORM\Column(type="integer")
     */
    private $documentid;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="Acces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Autorisation::class, inversedBy="acces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $autorisation;

    /**
     * @ORM\OneToOne(targetEntity=Document::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $agir;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateurid(): ?int
    {
        return $this->utilisateurid;
    }

    public function setUtilisateurid(int $utilisateurid): self
    {
        $this->utilisateurid = $utilisateurid;

        return $this;
    }

    public function getAutorisationid(): ?int
    {
        return $this->autorisationid;
    }

    public function setAutorisationid(int $autorisationid): self
    {
        $this->autorisationid = $autorisationid;

        return $this;
    }

    public function getDocumentid(): ?int
    {
        return $this->documentid;
    }

    public function setDocumentid(int $documentid): self
    {
        $this->documentid = $documentid;

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

    public function getAutorisation(): ?autorisation
    {
        return $this->autorisation;
    }

    public function setAutorisation(?autorisation $autorisation): self
    {
        $this->autorisation = $autorisation;

        return $this;
    }

    public function getAgir(): ?document
    {
        return $this->agir;
    }

    public function setAgir(document $agir): self
    {
        $this->agir = $agir;

        return $this;
    }
}
