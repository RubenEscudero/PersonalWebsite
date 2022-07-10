<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $created_at;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $updated_at;

    #[ORM\OneToMany(mappedBy: 'section_id', targetEntity: DataUser::class)]
    private $dataUsers;

    public function __construct()
    {
        $this->dataUsers = new ArrayCollection();
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
            $dataUser->setSection($this);
        }

        return $this;
    }

    public function removeDataUser(DataUser $dataUser): self
    {
        if ($this->dataUsers->removeElement($dataUser)) {
            // set the owning side to null (unless already changed)
            if ($dataUser->getSection() === $this) {
                $dataUser->setSection(null);
            }
        }

        return $this;
    }
}
