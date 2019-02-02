<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Post entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /** Timestampable trait */
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $mainImageFilename;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $PostType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PostTypeContent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getMainImageFilename(): ?string
    {
        return $this->mainImageFilename;
    }

    public function setMainImageFilename(?string $mainImageFilename): self
    {
        $this->mainImageFilename = $mainImageFilename;

        return $this;
    }

    public function getPostType(): ?string
    {
        return $this->PostType;
    }

    public function setPostType(string $PostType): self
    {
        $this->PostType = $PostType;

        return $this;
    }

    public function getPostTypeContent(): ?string
    {
        return $this->PostTypeContent;
    }

    public function setPostTypeContent(string $PostTypeContent): self
    {
        $this->PostTypeContent = $PostTypeContent;

        return $this;
    }
}
