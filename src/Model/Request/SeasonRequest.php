<?php

namespace App\Model\Request;

use DateTime;

class SeasonRequest{
    
    /**
     * @var int|null
     */
    private $numberSeason;

    /**
     * @var DateTime|null
     */
    private $releaseDate;

    /**
     * @var int|null
     */
    private $tvId;

    /**
     * Get the value of numberSeason
     *
     * @return  int|null
     */ 
    public function getNumberSeason()
    {
        return $this->numberSeason;
    }

    /**
     * Set the value of numberSeason
     *
     * @param  int|null  $numberSeason
     *
     * @return  self
     */ 
    public function setNumberSeason($numberSeason)
    {
        $this->numberSeason = $numberSeason;

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
     * Get the value of tvId
     *
     * @return  int|null
     */ 
    public function getTvId()
    {
        return $this->tvId;
    }

    /**
     * Set the value of tvId
     *
     * @param  int|null  $tvId
     *
     * @return  self
     */ 
    public function setTvId($tvId)
    {
        $this->tvId = $tvId;

        return $this;
    }
}