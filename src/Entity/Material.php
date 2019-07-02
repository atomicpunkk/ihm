<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaterialRepository")
 * @ApiResource(
 * normalizationContext={"groups"={"materials_read"}}
 * )
 */
class Material
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"materials_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"materials_read"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="materials")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"materials_read"})
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Input", mappedBy="material")
     * @Groups({"materials_read"})
     */
    private $inputs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Output", mappedBy="material")
     * @Groups({"materials_read"})
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
            $input->setMaterial($this);
        }

        return $this;
    }

    public function removeInput(Input $input): self
    {
        if ($this->inputs->contains($input)) {
            $this->inputs->removeElement($input);
            // set the owning side to null (unless already changed)
            if ($input->getMaterial() === $this) {
                $input->setMaterial(null);
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
            $output->setMaterial($this);
        }

        return $this;
    }

    public function removeOutput(Output $output): self
    {
        if ($this->outputs->contains($output)) {
            $this->outputs->removeElement($output);
            // set the owning side to null (unless already changed)
            if ($output->getMaterial() === $this) {
                $output->setMaterial(null);
            }
        }

        return $this;
    }
}
