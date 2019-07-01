<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MachineRepository")
 * @ApiResource
 */
class Machine
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="machines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Input", mappedBy="machine")
     */
    private $inputs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Output", mappedBy="machine")
     */
    private $outputs;

    public function __construct()
    {
        $this->inputs = new ArrayCollection();
        $this->outputs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Input[]
     */
    public function getInputs(): Collection
    {
        return $this->inputs;
    }

    public function addInput(Input $input): self
    {
        if (!$this->inputs->contains($input)) {
            $this->inputs[] = $input;
            $input->setMachine($this);
        }

        return $this;
    }

    public function removeInput(Input $input): self
    {
        if ($this->inputs->contains($input)) {
            $this->inputs->removeElement($input);
            // set the owning side to null (unless already changed)
            if ($input->getMachine() === $this) {
                $input->setMachine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Output[]
     */
    public function getOutputs(): Collection
    {
        return $this->outputs;
    }

    public function addOutput(Output $output): self
    {
        if (!$this->outputs->contains($output)) {
            $this->outputs[] = $output;
            $output->setMachine($this);
        }

        return $this;
    }

    public function removeOutput(Output $output): self
    {
        if ($this->outputs->contains($output)) {
            $this->outputs->removeElement($output);
            // set the owning side to null (unless already changed)
            if ($output->getMachine() === $this) {
                $output->setMachine(null);
            }
        }

        return $this;
    }
}
