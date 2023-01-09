<?php

namespace App\Enum;

class EntityEnum
{
    const GENRE = 'GENRE';
    const DIRECTOR = 'DIRECTOR';
    const ACTOR = 'ACTOR';
    const MOVIE = 'MOVIE';
    const TV = 'TV';
    const SEASON = 'SEASON';
    const EPISODE = 'EPISODE';

    public static function getEntities(): array
    {
        return array(self::GENRE,
            self::DIRECTOR,
            self::ACTOR,
            self::MOVIE,
            self::TV,
            self::SEASON,
            self::EPISODE,
        );
    }

}
