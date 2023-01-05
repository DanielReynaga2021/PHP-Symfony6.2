<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230105005321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE director (
            id INT auto_increment NOT NULL,
            name varchar(100),
            last_name varchar(100),
            date_birth DATE,
            created_at TIMESTAMP DEFAULT current_timestamp(),
            updated_at TIMESTAMP DEFAULT NULL,
            deleted_at TIMESTAMP DEFAULT NULL,
            enabled TINYINT DEFAULT 1,
            PRIMARY KEY (id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci;
            ;");

        $this->addSql("CREATE TABLE movie (
            id INT auto_increment NOT NULL,
            name varchar(100),
            release_date DATE,
            director_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT current_timestamp(),
            updated_at TIMESTAMP DEFAULT NULL,
            deleted_at TIMESTAMP DEFAULT NULL,
            enabled TINYINT DEFAULT 1,
            PRIMARY KEY (id),
            CONSTRAINT FK_movie FOREIGN KEY (director_id) REFERENCES director(id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci;
            ;");

        $this->addSql("CREATE TABLE actor (
            id INT auto_increment NOT NULL,
            name varchar(100),
            last_name varchar(100),
            date_birth DATE,
            director_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT current_timestamp(),
            updated_at TIMESTAMP DEFAULT NULL,
            deleted_at TIMESTAMP DEFAULT NULL,
            enabled TINYINT DEFAULT 1,
            PRIMARY KEY (id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci;
            ;");

        $this->addSql("CREATE TABLE tv (
            id INT auto_increment NOT NULL,
            name varchar(100),
            release_date DATE,
            director_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT current_timestamp(),
            updated_at TIMESTAMP DEFAULT NULL,
            deleted_at TIMESTAMP DEFAULT NULL,
            enabled TINYINT DEFAULT 1,
            PRIMARY KEY (id),
            CONSTRAINT FK_tv_director FOREIGN KEY (director_id) REFERENCES director(id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci;
            ;");

        $this->addSql("CREATE TABLE genre (
            id INT auto_increment NOT NULL,
            name varchar(100),
            created_at TIMESTAMP DEFAULT current_timestamp(),
            updated_at TIMESTAMP DEFAULT NULL,
            deleted_at TIMESTAMP DEFAULT NULL,
            enabled TINYINT DEFAULT 1,
            PRIMARY KEY (id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci;
            ;");

        $this->addSql("CREATE TABLE season (
            id INT auto_increment NOT NULL,
            number_season INT,
            release_date DATE,
            tv_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT current_timestamp(),
            updated_at TIMESTAMP DEFAULT NULL,
            deleted_at TIMESTAMP DEFAULT NULL,
            enabled TINYINT DEFAULT 1,
            PRIMARY KEY (id),
            CONSTRAINT FK_season_tv FOREIGN KEY (tv_id) REFERENCES tv(id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci;
            ;");

        $this->addSql("CREATE TABLE episode (
            id INT auto_increment NOT NULL,
            name varchar(100),
            number_episode INT,
            release_date DATE,
            season_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT current_timestamp(),
            updated_at TIMESTAMP DEFAULT NULL,
            deleted_at TIMESTAMP DEFAULT NULL,
            enabled TINYINT DEFAULT 1,
            PRIMARY KEY (id),
            CONSTRAINT FK_episode_season FOREIGN KEY (season_id) REFERENCES season(id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci;
            ;");

        $this->addSql("CREATE TABLE ref_actor_movie (
            movie_id INT NOT NULL,
            actor_id INT NOT NULL,
            PRIMARY KEY (movie_id,actor_id),
            CONSTRAINT FK_ref_movie FOREIGN KEY (movie_id) REFERENCES movie(id),
            CONSTRAINT FK_ref_actor FOREIGN KEY (actor_id) REFERENCES actor(id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci;
            ;");

        $this->addSql("CREATE TABLE ref_actor_tv (
            actor_id INT NOT NULL,
            tv_id INT NOT NULL,
            PRIMARY KEY (actor_id,tv_id),
            CONSTRAINT FK_ref_actor_tv FOREIGN KEY (actor_id) REFERENCES actor(id),
            CONSTRAINT FK_ref_tv FOREIGN KEY (tv_id) REFERENCES tv(id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci;
            ;");

        $this->addSql("CREATE TABLE ref_movie_genre (
            movie_id INT NOT NULL,
            genre_id INT NOT NULL,
            PRIMARY KEY (movie_id,genre_id),
            CONSTRAINT FK_ref_movie_genre FOREIGN KEY (movie_id) REFERENCES movie(id),
            CONSTRAINT FK_ref_genre FOREIGN KEY (genre_id) REFERENCES genre(id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci;
            ;");

        $this->addSql("CREATE TABLE ref_tv_genre (
            tv_id INT NOT NULL,
            genre_id INT NOT NULL,
            PRIMARY KEY (tv_id,genre_id),
            CONSTRAINT FK_ref_tv_genre FOREIGN KEY (tv_id) REFERENCES tv(id),
            CONSTRAINT FK_ref_genre_genre FOREIGN KEY (genre_id) REFERENCES genre(id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci;
            ;");

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE ref_tv_genre');
        $this->addSql('DROP TABLE ref_movie_genre');
        $this->addSql('DROP TABLE ref_actor_tv');
        $this->addSql('DROP TABLE ref_actor_movie');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE tv');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE director');
    }
}