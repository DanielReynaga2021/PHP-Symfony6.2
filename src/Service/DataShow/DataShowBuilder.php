<?php

namespace App\Service\DataShow;

use App\Enum\EntityEnum;
use App\Service\ActorService;
use App\Service\DirectorService;
use App\Service\EpisodeService;
use App\Service\GenreService;
use App\Service\MovieService;
use App\Service\SeasonService;
use App\Service\TvService;

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
            case EntityEnum::GENRE;
                return $this->genreService;
            case EntityEnum::DIRECTOR:
                return $this->directorService;
            case EntityEnum::ACTOR:
                return $this->actorService;
            case EntityEnum::MOVIE:
                return $this->movieService;
            case EntityEnum::TV:
                return $this->tvService;
            case EntityEnum::SEASON:
                return $this->seasonService;
            case EntityEnum::EPISODE:
                return $this->episodeService;
            default:
                break;
        }

    }

}
