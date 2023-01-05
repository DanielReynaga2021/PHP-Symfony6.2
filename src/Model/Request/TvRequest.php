<?php

namespace App\Model\Request;

use DateTime;

class TvRequest{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var DateTime|null
     */
    private $releaseDate;

    /**
     * @var int|null
     */
    private $directorId;

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
     * Get the value of directorId
     *
     * @return  int|null
     */ 
    public function getDirectorId()
    {
        return $this->directorId;
    }

    /**
     * Set the value of directorId
     *
     * @param  int|null  $directorId
     *
     * @return  self
     */ 
    public function setDirectorId($directorId)
    {
        $this->directorId = $directorId;

        return $this;
    }
}