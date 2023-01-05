<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Season
 *
 * @ORM\Table(name="season", indexes={@ORM\Index(name="FK_season_tv", columns={"tv_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\SeasonRepository")
 */
class Season
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="number_season", type="integer", nullable=true)
     */
    private $numberSeason;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="release_date", type="date", nullable=true)
     */
    private $releaseDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true, options={"default"="1"})
     */
    private $enabled = true;

    /**
     * @var \Tv
     *
     * @ORM\ManyToOne(targetEntity="Tv")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tv_id", referencedColumnName="id")
     * })
     */
    private $tv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberSeason(): ?int
    {
        return $this->numberSeason;
    }

    public function setNumberSeason(?int $numberSeason): self
    {
        $this->numberSeason = $numberSeason;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(?bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getTv(): ?Tv
    {
        return $this->tv;
    }

    public function setTv(?Tv $tv): self
    {
        $this->tv = $tv;

        return $this;
    }


}
