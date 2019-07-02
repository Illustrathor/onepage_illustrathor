<?php

namespace App\Extensions\Portfolio\Entity;

use Beelab\TagBundle\Tag\TaggableInterface;
use Beelab\TagBundle\Tag\TagInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Artgris\Bundle\MediaBundle\Form\Validator\Constraint as MediaAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Extensions\Portfolio\Repository\SerieRepository")
 * @UniqueEntity("slug")
 * @ORM\HasLifecycleCallbacks
 */
class Serie implements TaggableInterface
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
    private $code;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $labels = [
        "fr_FR" => "",
        "en_EN" => ""
    ];

    /**
     * @ORM\Column(type="boolean")
     */
    private $online;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cover_image;

    /**
     * @var string[]
     * @ORM\Column(type="array", nullable=true)
     * @MediaAssert\Image()
     */
    private $images = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $descriptions = [
        "fr_FR" => "",
        "en_EN" => ""
    ];

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_sent;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="series")
     */
    private $tags;

    private $tagsText;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLabels(): ?array
    {
        return $this->labels;
    }

    public function setLabels(array $labels): self
    {
        $this->labels = $labels;

        return $this;
    }

    public function getOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(bool $online): self
    {
        $this->online = $online;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->cover_image;
    }

    public function setCoverImage(?string $cover_image): self
    {
        $this->cover_image = $cover_image;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(?array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getDescriptions(): ?array
    {
        return $this->descriptions;
    }

    public function setDescriptions(?array $descriptions): self
    {
        $this->descriptions = $descriptions;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateSent()
    {
        return $this->date_sent;
    }
    /**
     * @param mixed $date_sent
     */
    public function setDateSent($date_sent): void
    {
        $this->date_sent = $date_sent;
    }
    /**
     * @ORM\PrePersist
     */
    public function onPrePersistSetRegistrationDate()
    {
        $this->date_sent = new \DateTime();
    }

    public function addTag(TagInterface $tag): void
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
    }

    public function removeTag(TagInterface $tag): void
    {
        $this->tags->removeElement($tag);
    }

    public function hasTag(TagInterface $tag): bool
    {
        return $this->tags->contains($tag);
    }

    public function getTags(): iterable
    {
        return $this->tags;
    }

    public function getTagNames(): array
    {
        return empty($this->tagsText) ? [] : \array_map('trim', explode(',', $this->tagsText));
    }

    public function setTagsText(?string $tagsText): void
    {
        $this->tagsText = $tagsText;
        $this->updated = new \DateTimeImmutable();
    }

    public function getTagsText(): ?string
    {
        $this->tagsText = \implode(', ', $this->tags->toArray());

        return $this->tagsText;
    }
}
