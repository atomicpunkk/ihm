<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OutputRepository")
 * @ApiResource
 */
class Output
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Machine", inversedBy="outputs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $machine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Material", inversedBy="outputs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $material;

    /**
     * @ORM\Column(type="string", length=255)
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
