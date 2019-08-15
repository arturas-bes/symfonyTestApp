<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User
{
//    Automatic doctrine lifecycles
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
//        var_dump($this->createdAt);
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
// cascade={"remove"} also lets delete items with forgein keys  ON APPLICATION LEVEL
//orphanRemoval=true means that item going to be deleted pernamently from Database otherwise on app level delete item frogein key gonna be assigned as null
// cascade={"persist", "remove"}) this used to avoid manualy persisting related object
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="user", cascade={"remove"}, orphanRemoval=true)
     */
    private $videos;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist", "remove"})
     */
    private $adress;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="following")
     */
    private $followed;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="followed")
     */
    private $following;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
        $this->followed = new ArrayCollection();
        $this->following = new ArrayCollection();
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

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setUser($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getUser() === $this) {
                $video->setUser(null);
            }
        }

        return $this;
    }

    public function getAdress(): ?Address
    {
        return $this->adress;
    }

    public function setAdress(?Address $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getFollowed(): Collection
    {
        return $this->followed;
    }

    public function addFollowed(self $followed): self
    {
        if (!$this->followed->contains($followed)) {
            $this->followed[] = $followed;
        }

        return $this;
    }

    public function removeFollowed(self $followed): self
    {
        if ($this->followed->contains($followed)) {
            $this->followed->removeElement($followed);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getFollowing(): Collection
    {
        return $this->following;
    }

    public function addFollowing(self $following): self
    {
        if (!$this->following->contains($following)) {
            $this->following[] = $following;
            $following->addFollowed($this);
        }

        return $this;
    }

    public function removeFollowing(self $following): self
    {
        if ($this->following->contains($following)) {
            $this->following->removeElement($following);
            $following->removeFollowed($this);
        }

        return $this;
    }
}
