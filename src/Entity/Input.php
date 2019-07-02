<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InputRepository")
 * @ApiResource(
 * normalizationContext={"groups"={"inputs_read"}}
 * )
 */
class Input
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"inputs_read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Machine", inversedBy="inputs")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"inputs_read"})
     */
    private $machine;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"inputs_read"})
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Material", inversedBy="inputs")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"inputs_read"})
     */
    private $material;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMachine(): ?Machine
    {
        return $this->machine;
    }

    public function setMachine(?Machine $machine): self
    {
        $this->machine = $machine;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(?Material $material): self
    {
        $this->material = $material;

        return $this;
    }
}
