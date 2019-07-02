<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiResource(
 * itemOperations={"GET","PUT"},
 * normalizationContext={"groups"={"users_read"}}
 * )
 *
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"users_read", "machines_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"users_read", "machines_read"})
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     * @Groups({"users_read", "machines_read"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"users_read", "machines_read"})
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Material", mappedBy="author")
     * @Groups({"users_read", "machines_read"})
     */
    private $materials;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Machine", mappedBy="author")
     * @Groups({"users_read"})
     */
    private $machines;

    public function __construct()
    {
        $this->materials = new ArrayCollection();
        $this->machines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Material[]
     */
    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    public function addMaterial(Material $material): self
    {
        if (!$this->materials->contains($material)) {
            $this->materials[] = $material;
            $material->setAuthor($this);
        }

        return $this;
    }

    public function removeMaterial(Material $material): self
    {
        if ($this->materials->contains($material)) {
            $this->materials->removeElement($material);
            // set the owning side to null (unless already changed)
            if ($material->getAuthor() === $this) {
                $material->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Machine[]
     */
    public function getMachines(): Collection
    {
        return $this->machines;
    }

    public function addMachine(Machine $machine): self
    {
        if (!$this->machines->contains($machine)) {
            $this->machines[] = $machine;
            $machine->setAuthor($this);
        }

        return $this;
    }

    public function removeMachine(Machine $machine): self
    {
        if ($this->machines->contains($machine)) {
            $this->machines->removeElement($machine);
            // set the owning side to null (unless already changed)
            if ($machine->getAuthor() === $this) {
                $machine->setAuthor(null);
            }
        }

        return $this;
    }
}
