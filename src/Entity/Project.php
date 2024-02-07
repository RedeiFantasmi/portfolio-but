<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $context = null;

    #[ORM\Column]
    private ?int $timePassed = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $location = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: ProjectTag::class, inversedBy: 'projects')]
    private Collection $tags;

    #[ORM\ManyToMany(targetEntity: Skill::class, inversedBy: 'projects')]
    private Collection $technologies;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $didAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $summary = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cover = null;

    #[ORM\ManyToMany(targetEntity: ButSkill::class, inversedBy: 'projects')]
    private Collection $butSkills;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $github = null;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->technologies = new ArrayCollection();
        $this->butSkills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function setContext(?string $context): static
    {
        $this->context = $context;

        return $this;
    }

    public function getTimePassed(): ?int
    {
        return $this->timePassed;
    }

    public function setTimePassed(int $timePassed): static
    {
        $this->timePassed = $timePassed;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, ProjectTag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(ProjectTag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(ProjectTag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getTechnologies(): Collection
    {
        return $this->technologies;
    }

    public function addTechnology(Skill $technology): static
    {
        if (!$this->technologies->contains($technology)) {
            $this->technologies->add($technology);
        }

        return $this;
    }

    public function removeTechnology(Skill $technology): static
    {
        $this->technologies->removeElement($technology);

        return $this;
    }

    public function getDidAt(): ?\DateTimeImmutable
    {
        return $this->didAt;
    }

    public function setDidAt(\DateTimeImmutable $didAt): static
    {
        $this->didAt = $didAt;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): static
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * @return Collection<int, ButSkill>
     */
    public function getButSkills(): Collection
    {
        return $this->butSkills;
    }

    public function addButSkill(ButSkill $butSkill): static
    {
        if (!$this->butSkills->contains($butSkill)) {
            $this->butSkills->add($butSkill);
        }

        return $this;
    }

    public function removeButSkill(ButSkill $butSkill): static
    {
        $this->butSkills->removeElement($butSkill);

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): static
    {
        $this->github = $github;

        return $this;
    }
}
