<?php

namespace App\Model\Request;

use DateTime;

class EpisodeRequest{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var int|null
     */
    private $numberEpisode;

    /**
     * @var DateTime|null
     */
    private $releaseDate;

    /**
     * @var int|null
     */
    private $seasonId;

    /**
     * Get the value of name
     *
     * @return  string|null
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string|null  $name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of numberEpisode
     *
     * @return  int|null
     */ 
    public function getNumberEpisode()
    {
        return $this->numberEpisode;
    }

    /**
     * Set the value of numberEpisode
     *
     * @param  int|null  $numberEpisode
     *
     * @return  self
     */ 
    public function setNumberEpisode($numberEpisode)
    {
        $this->numberEpisode = $numberEpisode;

        return $this;
    }

    /**
     * Get the value of releaseDate
     *
     * @return  DateTime|null
     */ 
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set the value of releaseDate
     *
     * @param  DateTime|null  $releaseDate
     *
     * @return  self
     */ 
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get the value of seasonId
     *
     * @return  int|null
     */ 
    public function getSeasonId()
    {
        return $this->seasonId;
    }

    /**
     * Set the value of seasonId
     *
     * @param  int|null  $seasonId
     *
     * @return  self
     */ 
    public function setSeasonId($seasonId)
    {
        $this->seasonId = $seasonId;

        return $this;
    }
}