<?php

namespace App\Entity;

use App\Extensions\Portfolio\Entity\Portrait;
use App\Extensions\Portfolio\Entity\Publication;
use App\Extensions\Portfolio\Entity\Serie;
use App\Extensions\Portfolio\Entity\Son;
use Beelab\TagBundle\Tag\TagInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Tag implements TagInterface
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column()
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Extensions\Portfolio\Entity\Portrait", mappedBy="tags")
     */
    private $portraits;

    /**
     * @ORM\ManyToMany(targetEntity="App\Extensions\Portfolio\Entity\Serie", mappedBy="tags")
     */
    private $series;

    /**
     * @ORM\ManyToMany(targetEntity="App\Extensions\Portfolio\Entity\Publication", mappedBy="tags")
     */
    private $publications;

    /**
     * @ORM\ManyToMany(targetEntity="App\Extensions\Portfolio\Entity\Son", mappedBy="tags")
     */
    private $sons;


    public function __construct()
    {
        $this->portraits = new ArrayCollection();
        $this->series = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return Collection|Portrait[]
     */
    public function getPortraits(): Collection
    {
        return $this->portraits;
    }

    public function addPortrait(Portrait $portrait): self
    {
        if (!$this->portraits->contains($portrait)) {
            $this->portraits[] = $portrait;
            $portrait->addTag($this);
        }

        return $this;
    }

    public function removePortrait(Portrait $portrait): self
    {
        if ($this->portraits->contains($portrait)) {
            $this->portraits->removeElement($portrait);
            $portrait->removeTag($this);
        }

        return $this;
    }

    /**
     * @return Collection|Serie[]
     */
    public function getSeries(): Collection
    {
        return $this->series;
    }

    public function addSerie(Serie $serie): self
    {
        if (!$this->series->contains($serie)) {
            $this->series[] = $serie;
            $serie->addTag($this);
        }

        return $this;
    }

    public function removeSerie(Serie $serie): self
    {
        if ($this->series->contains($serie)) {
            $this->series->removeElement($serie);
            $serie->removeTag($this);
        }

        return $this;
    }

    /**
     * @return Collection|Publication[]
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publication $publication): self
    {
        if (!$this->publications->contains($publication)) {
            $this->publications[] = $publication;
            $publication->addTag($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): self
    {
        if ($this->publications->contains($publication)) {
            $this->publications->removeElement($publication);
            $publication->removeTag($this);
        }

        return $this;
    }


    /**
     * @return Collection|Son[]
     */
    public function getSons(): Collection
    {
        return $this->sons;
    }

    public function addSon(Son $son): self
    {
        if (!$this->sons->contains($son)) {
            $this->sons[] = $son;
            $son->addTag($this);
        }

        return $this;
    }

    public function removeSon(Son $son): self
    {
        if ($this->sons->contains($son)) {
            $this->sons->removeElement($son);
            $son->removeTag($this);
        }

        return $this;
    }
}

