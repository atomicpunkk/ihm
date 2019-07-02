<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OutputRepository")
 * @ApiResource(
 * normalizationContext={"groups"={"outputs_read"}}
 * )
 */
class Output
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"outputs_read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Machine", inversedBy="outputs")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"outputs_read"})
     */
    private $machine;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"outputs_read"})
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Material", inversedBy="outputs")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"outputs_read"})
     */
    private $material;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"outputs_read"})
     */
    private $outputTime;

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

    public function getOutputTime(): ?string
    {
        return $this->outputTime;
    }

    public function setOutputTime(string $outputTime): self
    {
        $this->outputTime = $outputTime;

        return $this;
    }
}
