<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfileRepository")
 */
class Profile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $avatarImageFileName;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $twitterAccount;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $facebookAccount;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $instagramAccount;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $youtubeAccount;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $websiteUrl;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $slackAccount;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="profile", cascade={"persist", "remove"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvatarImageFileName(): ?string
    {
        return $this->avatarImageFileName;
    }

    public function setAvatarImageFileName(?string $avatarImageFileName): self
    {
        $this->avatarImageFileName = $avatarImageFileName;

        return $this;
    }

    public function getTwitterAccount(): ?string
    {
        return $this->twitterAccount;
    }

    public function setTwitterAccount(?string $twitterAccount): self
    {
        $this->twitterAccount = $twitterAccount;

        return $this;
    }

    public function getFacebookAccount(): ?string
    {
        return $this->facebookAccount;
    }

    public function setFacebookAccount(?string $facebookAccount): self
    {
        $this->facebookAccount = $facebookAccount;

        return $this;
    }

    public function getInstagramAccount(): ?string
    {
        return $this->instagramAccount;
    }

    public function setInstagramAccount(?string $instagramAccount): self
    {
        $this->instagramAccount = $instagramAccount;

        return $this;
    }

    public function getYoutubeAccount(): ?string
    {
        return $this->youtubeAccount;
    }

    public function setYoutubeAccount(?string $youtubeAccount): self
    {
        $this->youtubeAccount = $youtubeAccount;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(?string $websiteUrl): self
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    public function getSlackAccount(): ?string
    {
        return $this->slackAccount;
    }

    public function setSlackAccount(string $slackAccount): self
    {
        $this->slackAccount = $slackAccount;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        // set the owning side of the relation if necessary
        if ($this !== $user->getProfile()) {
            $user->setProfile($this);
        }

        return $this;
    }
}
