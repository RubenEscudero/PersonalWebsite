<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private ?string $email;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $password;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $surname;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $profile_picture;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: SocialMedia::class)]
    private ArrayCollection $social_media_id;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $created_at;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $updated_at;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Blog::class)]
    private $blogs;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: DataUser::class)]
    private $dataUsers;

    public function __construct()
    {
        $this->social_media_id = new ArrayCollection();
        $this->blogs = new ArrayCollection();
        $this->dataUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

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

    public function getProfilePicture(): ?string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(string $profile_picture): self
    {
        $this->profile_picture = $profile_picture;

        return $this;
    }

    /**
     * @return Collection<int, SocialMedia>
     */
    public function getSocialMediaId(): Collection
    {
        return $this->social_media_id;
    }

    public function addSocialMediaId(SocialMedia $socialMediaId): self
    {
        if (!$this->social_media_id->contains($socialMediaId)) {
            $this->social_media_id[] = $socialMediaId;
            $socialMediaId->setUser($this);
        }

        return $this;
    }

    public function removeSocialMediaId(SocialMedia $socialMediaId): self
    {
        if ($this->social_media_id->removeElement($socialMediaId)) {
            // set the owning side to null (unless already changed)
            if ($socialMediaId->getUser() === $this) {
                $socialMediaId->setUser(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @return Collection<int, Blog>
     */
    public function getBlogs(): Collection
    {
        return $this->blogs;
    }

    public function addBlog(Blog $blog): self
    {
        if (!$this->blogs->contains($blog)) {
            $this->blogs[] = $blog;
            $blog->setUser($this);
        }

        return $this;
    }

    public function removeBlog(Blog $blog): self
    {
        if ($this->blogs->removeElement($blog)) {
            // set the owning side to null (unless already changed)
            if ($blog->getUser() === $this) {
                $blog->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DataUser>
     */
    public function getDataUsers(): Collection
    {
        return $this->dataUsers;
    }

    public function addDataUser(DataUser $dataUser): self
    {
        if (!$this->dataUsers->contains($dataUser)) {
            $this->dataUsers[] = $dataUser;
            $dataUser->setUser($this);
        }

        return $this;
    }

    public function removeDataUser(DataUser $dataUser): self
    {
        if ($this->dataUsers->removeElement($dataUser)) {
            // set the owning side to null (unless already changed)
            if ($dataUser->getUser() === $this) {
                $dataUser->setUser(null);
            }
        }

        return $this;
    }
}
