<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestRepository::class)
 */
class Test
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $Note;

    /**
     * @ORM\Column(type="text")
     */
    private $Contenu;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTesteur;

    /**
     * @ORM\OneToOne(targetEntity=Jeu::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idJeu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->Note;
    }

    public function setNote(int $Note): self
    {
        $this->Note = $Note;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->Contenu;
    }

    public function setContenu(string $Contenu): self
    {
        $this->Contenu = $Contenu;

        return $this;
    }

    public function getIdTesteur(): ?User
    {
        return $this->idTesteur;
    }

    public function setIdTesteur(?User $idTesteur): self
    {
        $this->idTesteur = $idTesteur;

        return $this;
    }

    public function getIdJeu(): ?Jeu
    {
        return $this->idJeu;
    }

    public function setIdJeu(Jeu $idJeu): self
    {
        $this->idJeu = $idJeu;

        return $this;
    }
}
