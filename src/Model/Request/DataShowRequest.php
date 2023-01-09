<?php

namespace App\Model\Request;

use App\Enum\EntityEnum;
use Symfony\Component\Validator\Constraints as Assert;

class DataShowRequest{
    /**
     * @Assert\Choice( callback={"App\Enum\EntityEnum", "getEntities"}, message="Invalid Entity")
     * @Assert\NotBlank(message="field is required")
     * @Assert\NotNull(message="field is required")
     * @Assert\Length(max=255, maxMessage="The field must be lower than {{ limit }}")
     * @Assert\Type("string", message="field must be {{ type }}")
     */
    private $entity;

    /**
     * @var ActorReques|null
     */
    private $actor;

    /**
     * @var DirectorRequest|null
     */
    private $director;

    /**
     * @var EpisodeRequest|null
     */
    private $episode;

    /**
     * @var GenreRequest|null
     */
    private $genre;

    /**
     * @var MovieRequest|null
     */
    private $movie;

    /**
     * @var SeasonRequest|null
     */
    private $season;

    /**
     * @var TvRequest|null
     */
    private $tv;


    /**
     * Get the value of entity
     *
     * @return  string|null
     */ 
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set the value of entity
     *
     * @param  string|null  $entity
     *
     * @return  self
     */ 
    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get the value of genre
     *
     * @return  GenreRequest|null
     */ 
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set the value of genre
     *
     * @param  GenreRequest|null  $genre
     *
     * @return  self
     */ 
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get the value of actor
     *
     * @return  ActorReques|null
     */ 
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * Set the value of actor
     *
     * @param  ActorReques|null  $actor
     *
     * @return  self
     */ 
    public function setActor($actor)
    {
        $this->actor = $actor;

        return $this;
    }

    /**
     * Get the value of director
     *
     * @return  DirectorRequest|null
     */ 
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set the value of director
     *
     * @param  DirectorRequest|null  $director
     *
     * @return  self
     */ 
    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get the value of episode
     *
     * @return  EpisodeRequest|null
     */ 
    public function getEpisode()
    {
        return $this->episode;
    }

    /**
     * Set the value of episode
     *
     * @param  EpisodeRequest|null  $episode
     *
     * @return  self
     */ 
    public function setEpisode($episode)
    {
        $this->episode = $episode;

        return $this;
    }

    /**
     * Get the value of movie
     *
     * @return  MovieRequest|null
     */ 
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set the value of movie
     *
     * @param  MovieRequest|null  $movie
     *
     * @return  self
     */ 
    public function setMovie($movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get the value of season
     *
     * @return  SeasonRequest|null
     */ 
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set the value of season
     *
     * @param  SeasonRequest|null  $season
     *
     * @return  self
     */ 
    public function setSeason($season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Get the value of tv
     *
     * @return  TvRequest|null
     */ 
    public function getTv()
    {
        return $this->tv;
    }

    /**
     * Set the value of tv
     *
     * @param  TvRequest|null  $tv
     *
     * @return  self
     */ 
    public function setTv($tv)
    {
        $this->tv = $tv;

        return $this;
    }
}