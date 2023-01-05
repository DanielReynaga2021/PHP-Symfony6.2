<?php

namespace App\Service\DataShow;

use App\Service\ActorService;
use App\Service\EpisodeService;
use App\Service\GenreService;
use App\Service\DirectorService;
use App\Service\MovieService;
use App\Service\TvService;
use App\Service\SeasonService;

class DataShowBuilder
{
    /**
     * @var GenreService
     */
    private $genreService;

    /**
     * @var DirectorService
     */
    private $directorService;

    /**
     * @var ActorService
     */
    private $actorService;

    /**
     * @var MovieService
     */
    private $movieService;

    /**
     * @var TvService
     */
    private $tvService;

    /**
     * @var SeasonService
     */
    private $seasonService;

    /**
     * @var EpisodeService
     */
    private $episodeService;

    public function __construct(
        GenreService $genreService,
        DirectorService $directorService,
        ActorService $actorService,
        MovieService $movieService,
        TvService $tvService,
        SeasonService $seasonService,
        EpisodeService $episodeService,
    ) {
        $this->genreService = $genreService;
        $this->directorService = $directorService;
        $this->actorService = $actorService;
        $this->movieService = $movieService;
        $this->tvService = $tvService;
        $this->seasonService = $seasonService;
        $this->episodeService = $episodeService;
    }

    public function getConcreteClass(string $entity)
    {
        switch ($entity) {
            case "GENRE":
                return $this->genreService;
            case "DIRECTOR":
                return $this->directorService;
            case "ACTOR":
                return $this->actorService;
            case "MOVIE":
                return $this->movieService;
            case "TV":
                return $this->tvService;
            case "SEASON":
                return $this->seasonService;
            case "EPISODE":
                return $this->episodeService; 
        }

    }

}
