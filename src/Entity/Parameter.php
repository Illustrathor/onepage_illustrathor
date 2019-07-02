<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Artgris\Bundle\MediaBundle\Form\Validator\Constraint as MediaAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterRepository")
 */
class Parameter
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
     * @ORM\Column(type="array")
     */
    private $labels = [
        "fr_FR" => "",
        "en_EN" => ""
    ];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $parameters;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $template;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string[]
     * @ORM\Column(type="array", nullable=true)
     * @MediaAssert\Image()
     */
    private $images = [];

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

    public function getOneLabel($locale)
    {
        return $this->labels[$locale];
    }

    public function setLabels(array $labels): self
    {
        $this->labels = $labels;

        return $this;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getOneParameter($code)
    {
        $value = $this->getParameters();
        $iteration = 0;
        foreach (explode('.', $code) as $index) {
            $value = ($iteration == 0) ?  : $value.$index;
            $iteration++;
        }
        return $value;
    }

    public function setParameters($parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(?string $template): self
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(?array $images): self
    {
        $this->images = $images;

        return $this;
    }}
