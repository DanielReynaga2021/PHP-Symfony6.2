<?php

namespace App\Model\Response;

class EpisodeResponse{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $numberEpisode;

    /**
     * @var string
     */
    private $releaseDate;

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of numberEpisode
     *
     * @return  int
     */ 
    public function getNumberEpisode()
    {
        return $this->numberEpisode;
    }

    /**
     * Set the value of numberEpisode
     *
     * @param  int  $numberEpisode
     *
     * @return  self
     */ 
    public function setNumberEpisode(int $numberEpisode)
    {
        $this->numberEpisode = $numberEpisode;

        return $this;
    }

    /**
     * Get the value of releaseDate
     *
     * @return  string
     */ 
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set the value of releaseDate
     *
     * @param  string  $releaseDate
     *
     * @return  self
     */ 
    public function setReleaseDate(string $releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }
}