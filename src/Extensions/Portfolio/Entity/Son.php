<?php

namespace App\Extensions\Portfolio\Entity;

use App\Entity\User;
use Beelab\TagBundle\Tag\TagInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Extensions\Portfolio\Repository\SonRepository")
 * @UniqueEntity("slug")
 */
class Son
{
    const TYPES = [
        'Multimedia' => "youtube",
        'Son' => "soundcloud"
    ];

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
     * @ORM\Column(type="array")
     */
    private $labels = [
        "fr_FR" => "",
        "en_EN" => ""
    ];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $descriptions = [
        "fr_FR" => "",
        "en_EN" => ""
    ];

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="sons")
     */
    private $tags;

    private $tagsText;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=555)
     */
    private $link;

    /**
     * @ORM\Column(type="boolean")
     */
    private $online;

    /**
     * @ORM\Column(type="string")
     */
    private $type = "youtube";

    /**
     * @var string
     */
    private $embed;

    private function convertYoutube($string, $width, $height) {
        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "<div class=\"embed-responsive embed-responsive-4by3\"><iframe class=\"embed-responsive-item\" width=\"".$width."\" height=\"".$height."\" src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe></div>",
            $string
        );
    }

    private function convertSoundcloud($text, $width, $height)
    {
        $text = preg_replace('#https{0,1}:\/\/w{0,3}\.*soundcloud\.com\/([^< ]+)#ix',
            '<div class="container"><iframe class=""  width="'.$width.'" height="'.$height.'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https://soundcloud.com/$1&amp;color=00aabb&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe></div>',
            $text);
        return $text;
    }

    /**
     * @return string|null
     */
    public function getEmbed()
    {
        return $this->embed;
    }

    public function setEmbed($ytOptions = ["100%", "162"], $sdOption = ["500px", "166"])
    {
        switch ($this->getType())
        {
            case 'youtube':
                $this->embed = $this->convertYoutube($this->getLink(), $ytOptions[0], $ytOptions[1]);
                break;

            case 'soundcloud':
                $this->embed = $this->convertSoundcloud($this->getLink(), "100%", 100);
                break;

            default:
                $this->embed = null;
        }
        return $this;
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

    public function getDescriptions(): ?array
    {
        return $this->descriptions;
    }

    public function setDescriptions(?array $descriptions): self
    {
        $this->descriptions = $descriptions;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
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
        $this->tagsText = (!empty($this->tags)) ? \implode(', ', $this->tags->toArray()) : "";

        return $this->tagsText;
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

    public function getOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(bool $online): self
    {
        $this->online = $online;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }
}
