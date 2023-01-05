# PHP-Symfony6.2

Repositorio destinado a la consulta de Peliculas, Programas de Tv, Actores y Directores.
Esta diseñado con PHP 8.2 y symfony 6.2

## Requisitos
- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/download/)
- [Symfony](https://symfony.es/pagina/descargar/)
- [Symfony CLI ](https://symfony.com/download)

## Instalacion
Una vez clonado el repositorio, nos paramos dentro proyecto y ejecutamos en la consola de comandos
~~~~~~~~~~~~~~~~~~~
php bin/console lexik:jwt:generate-keypair
~~~~~~~~~~~~~~~~~~~
para generar una secret key.

Luego levantamos el proyecto ejecutando en consola
~~~~~~~~~~~~~~~~~~~
symfony server:start
~~~~~~~~~~~~~~~~~~~
Ante cualquier incoveniente limpiamos la cache y luego levantamos el proyecto.
~~~~~~~~~~~~~~~~~~~
php symfony cache:clear
~~~~~~~~~~~~~~~~~~~

## Endpoints

#### createUser
Descripcion: servicio utilizado para poder registrarnos.
Metodo HTTP: POST
~~~~~~~~~~~~~~~~~~~
URL: http://localhost:8000/createUser
~~~~~~~~~~~~~~~~~~~
Request:
~~~~~~~~~~~~~~~~~~~
{
    "email": "test@gmail.com",
    "password": "1234567"
}
~~~~~~~~~~~~~~~~~~~

Response:
~~~~~~~~~~~~~~~~~~~
{
    "result": "ok"
}
~~~~~~~~~~~~~~~~~~~

CURL:
~~~~~~~~~~~~~~~~~~~
curl --location --request POST 'http://localhost:8000/createUser' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email": "testgmail.com",
    "password": "1234567"
}'
~~~~~~~~~~~~~~~~~~~
Advertencia: El email no se puede repetir. 

---
#### login_check
Descripcion: servicio utilizado para poder loguearse en el sistema, este generar un token para poder usar algunos endpoinst, tambien genera un "refresh_token" para poder actulizar el limite de tiempo del token.
Metodo HTTP: POST
~~~~~~~~~~~~~~~~~~~
URL: http://localhost:8000/api/login_check
~~~~~~~~~~~~~~~~~~~
Request:
~~~~~~~~~~~~~~~~~~~
{
    "username": "test@gmail.com",
    "password": "1234567"
}
~~~~~~~~~~~~~~~~~~~

Response:
~~~~~~~~~~~~~~~~~~~
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzI5Mzg3NTQsImV4cCI6MTY3Mjk0MjM1NCwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6InRlc3RAZ21haWwuY29tIn0.nBjAjTIEIwHN3KbxOMRbuerHCxzYX4aCyXQf95S2LYxQpmD9NysEXxk8PT05OOkE6Ee37s22UuvQIQUjL47pBoSEVh0i4QUZnpix8W72-LPr-HGk35tDT8hFby8FeuFRKctPd-teCWl79tPkWlH1WM_Vjjymi7KciFOc5PSE6gVdLOSx3hZjIoE7lc4FPGiI1oi26HYeVEccIK4RHnD5F0TT0yPluU9-bVES2vm_0gKDbOEWLpPeg4YXE9bbEwc22oxNlGxAjcMEbccKG5ECszW42c_e03juzKcGkm-YQbIO1ftsL03qCDl9V2iYmZ0OisNLB_Wc96HfrGPsArHcvQ",
    "refresh_token": "2b5bfdb69f2ecf762cb90cbacb52adc4a2ee8ae87035e38cd80f5d82a2f38f1761d2c8056f4a42beb20b0e16def8b3cb6a89fb52184cbbdd47ac05281663234c"
}
~~~~~~~~~~~~~~~~~~~
CURL:
~~~~~~~~~~~~~~~~~~~
curl --location --request POST 'http://localhost:8000/api/login_check' \
--header 'Content-Type: application/json' \
--data-raw '{
    "username": "test@gmail.com",
    "password": "1234567"
}'
~~~~~~~~~~~~~~~~~~~
Advertencia: El token generado tiene duracion de 1 hora, luego expirara y no podra seguir usando algunos endpoints.
Para poder generar otro token debe loguearse de nuevo o refrescar el token con el "refresh_token".

---
#### refresh
Descripcion: servicio utilizado para actulizar el limite de tiempo del token.
Metodo HTTP: POST
~~~~~~~~~~~~~~~~~~~
URL: http://localhost:8000/api/token/refresh
~~~~~~~~~~~~~~~~~~~
Request:
~~~~~~~~~~~~~~~~~~~
{
    "refresh_token": "4b0dcedb49059665db20890a7b6cfb5827b0d34b2afbe7e4d34692c8613c76b767858cc81a9b2e94cb6f4369c1a2dc13e5fab13725fa6c2aa5b217230f7be1e8"
}
~~~~~~~~~~~~~~~~~~~

Response:
~~~~~~~~~~~~~~~~~~~
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzI5Mzk0ODgsImV4cCI6MTY3Mjk0MzA4OCwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6InRlc3RAZ21haWwuY29tIn0.kgJOsqkReysa5DuOVIgJzinSNfVHsk32n2BAWOzbIYNCfJ9K4owTdzyvE9aiAe2qp3-sHYKgR5_DuVHjkErS1fws0i44uo78n-RnixxvCy_gFk8TUtCCU8FDk2D_KVYF6BDwURuzxJEWGzx9WAtdoDPJGGbgI6aVeDnqHVeoPIX5_AyjPPjYxJlP4RceMGtEnQjQAnv8Qefflp73MYYAKTNhqbQcxKs5rGLTjyvaXKLzwd82BE8bQyxIhVA6BAQRv-fUpxtN3yRfdRKgqJOOnr-QVW6oSQS-la8FnhWzmGlQB__FhS0OmvSbcRQ-N-aHYPv3q18gOl-EaJpRlyFBxw",
    "refresh_token": "4b0dcedb49059665db20890a7b6cfb5827b0d34b2afbe7e4d34692c8613c76b767858cc81a9b2e94cb6f4369c1a2dc13e5fab13725fa6c2aa5b217230f7be1e8"
}
~~~~~~~~~~~~~~~~~~~
CURL:
~~~~~~~~~~~~~~~~~~~
curl --location --request POST 'http://localhost:8000/api/token/refresh' \
--header 'Content-Type: application/json' \
--data-raw '{
    "refresh_token": "4b0dcedb49059665db20890a7b6cfb5827b0d34b2afbe7e4d34692c8613c76b767858cc81a9b2e94cb6f4369c1a2dc13e5fab13725fa6c2aa5b217230f7be1e8"
}'
~~~~~~~~~~~~~~~~~~~
Advertencia: El nuevo token generado tiene duracion de 2 horas.

-----
#### movie
Descripcion: Servicio utilizado para consultar las peliculas. Ademas tiene filtros por nombre y fecha.
Metodo HTTP: GET
Parametros:


<a href="https://ibb.co/X351Fx2"><img src="https://i.ibb.co/dLpFk4W/Captura-de-pantalla-de-2023-01-05-14-34-49.png" alt="Captura-de-pantalla-de-2023-01-05-14-34-49" border="0"></a>
~~~~~~~~~~~~~~~~~~~
URL: http://localhost:8000/api/movie?filter.name=jurassic park&order.name=asc&order.release.date=desc&filter.release.date=09-06-1993
~~~~~~~~~~~~~~~~~~~
Authorization Type Token Bear

Response:
~~~~~~~~~~~~~~~~~~~
{
    "Movies": [
        {
            "id": 1,
            "name": "rescatando al soldado ryan",
            "releaseDate": "24-07-1998"
        },
        {
            "id": 2,
            "name": "jurassic park",
            "releaseDate": "09-06-1993"
        },
        {
            "id": 3,
            "name": "Nicolas!",
            "releaseDate": "11-02-1993"
        },
        {
            "id": 4,
            "name": "Nicolas!",
            "releaseDate": "11-02-1993"
        }
    ]
}
~~~~~~~~~~~~~~~~~~~
CURL:
~~~~~~~~~~~~~~~~~~~
curl --location --request GET 'http://localhost:8000/api/movie?filter.name=jurassic park&order.name=asc&order.release.date=desc&filter.release.date=09-06-1993' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzI5Mzk0ODgsImV4cCI6MTY3Mjk0MzA4OCwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6InRlc3RAZ21haWwuY29tIn0.kgJOsqkReysa5DuOVIgJzinSNfVHsk32n2BAWOzbIYNCfJ9K4owTdzyvE9aiAe2qp3-sHYKgR5_DuVHjkErS1fws0i44uo78n-RnixxvCy_gFk8TUtCCU8FDk2D_KVYF6BDwURuzxJEWGzx9WAtdoDPJGGbgI6aVeDnqHVeoPIX5_AyjPPjYxJlP4RceMGtEnQjQAnv8Qefflp73MYYAKTNhqbQcxKs5rGLTjyvaXKLzwd82BE8bQyxIhVA6BAQRv-fUpxtN3yRfdRKgqJOOnr-QVW6oSQS-la8FnhWzmGlQB__FhS0OmvSbcRQ-N-aHYPv3q18gOl-EaJpRlyFBxw'
~~~~~~~~~~~~~~~~~~~
---
#### Episode
Descripcion: Servicio utilizado para consultar el episodio por programa de TV.
Metodo HTTP: GET
~~~~~~~~~~~~~~~~~~~
URL: http://localhost:8000/api/episode/{numberEpisode}/{nameTvShow} 
~~~~~~~~~~~~~~~~~~~
Authorization Type Token Bear

Response:
~~~~~~~~~~~~~~~~~~~
{
    "Episode": {
        "id": 2,
        "name": "The one where Rachel finds out",
        "numberEpisode": 1,
        "releaseDate": "24-09-1994"
    },
    "Director": {
        "id": 1,
        "name": "James",
        "lastName": "Burrows",
        "dateBirth": "24-09-1994"
    }
}
~~~~~~~~~~~~~~~~~~~
CURL:
~~~~~~~~~~~~~~~~~~~
curl --location --request GET 'http://localhost:8000/api/episode/1/friends' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzI5Mzk0ODgsImV4cCI6MTY3Mjk0MzA4OCwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6InRlc3RAZ21haWwuY29tIn0.kgJOsqkReysa5DuOVIgJzinSNfVHsk32n2BAWOzbIYNCfJ9K4owTdzyvE9aiAe2qp3-sHYKgR5_DuVHjkErS1fws0i44uo78n-RnixxvCy_gFk8TUtCCU8FDk2D_KVYF6BDwURuzxJEWGzx9WAtdoDPJGGbgI6aVeDnqHVeoPIX5_AyjPPjYxJlP4RceMGtEnQjQAnv8Qefflp73MYYAKTNhqbQcxKs5rGLTjyvaXKLzwd82BE8bQyxIhVA6BAQRv-fUpxtN3yRfdRKgqJOOnr-QVW6oSQS-la8FnhWzmGlQB__FhS0OmvSbcRQ-N-aHYPv3q18gOl-EaJpRlyFBxw'
~~~~~~~~~~~~~~~~~~~
---
#### dataShow
Descripcion: Servicio utilizado para poder subir informacion a la base de datos segun el JSON.
Metodo HTTP: POST
~~~~~~~~~~~~~~~~~~~
URL: http://localhost:8000/api/dataShow
~~~~~~~~~~~~~~~~~~~
Authorization Type Token Bear

JSON Request: Generos
~~~~~~~~~~~~~~~~~~~
{
    "entity": "GENRE",
    "genre": {
        "name": "Terror"
    }
}
~~~~~~~~~~~~~~~~~~~
CURL:
~~~~~~~~~~~~~~~~~~~
curl --location --request POST 'http://localhost:8000/api/dataShow' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzI5Mzk0ODgsImV4cCI6MTY3Mjk0MzA4OCwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6InRlc3RAZ21haWwuY29tIn0.kgJOsqkReysa5DuOVIgJzinSNfVHsk32n2BAWOzbIYNCfJ9K4owTdzyvE9aiAe2qp3-sHYKgR5_DuVHjkErS1fws0i44uo78n-RnixxvCy_gFk8TUtCCU8FDk2D_KVYF6BDwURuzxJEWGzx9WAtdoDPJGGbgI6aVeDnqHVeoPIX5_AyjPPjYxJlP4RceMGtEnQjQAnv8Qefflp73MYYAKTNhqbQcxKs5rGLTjyvaXKLzwd82BE8bQyxIhVA6BAQRv-fUpxtN3yRfdRKgqJOOnr-QVW6oSQS-la8FnhWzmGlQB__FhS0OmvSbcRQ-N-aHYPv3q18gOl-EaJpRlyFBxw' \
--header 'Content-Type: application/json' \
--data-raw '{
    "entity": "GENRE",
    "genre": {
        "name": "Terror"
    }
}'
~~~~~~~~~~~~~~~~~~~
JSON Request: Director
~~~~~~~~~~~~~~~~~~~
{
    "entity": "DIRECTOR",
    "director": {
        "name": "daniel",
        "lastName": "reynaga",
        "dateBirth": "15-02-1993"
    }
}
~~~~~~~~~~~~~~~~~~~
CURL:
~~~~~~~~~~~~~~~~~~~
curl --location --request POST 'http://localhost:8000/api/dataShow' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzI4OTkxMjgsImV4cCI6MTY3MjkwMjcyOCwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6InRlc3QxQGdtYWlsLmNvbSJ9.bk1DW2BTgzoyWmmUtYtu8-93C-kjInrFM5GluBTmPTtYrztS5xCRoeEDrC-cv6Wa9yZaEa0oEvFXGt0pHFYjCAY9f6uhSeRxRArPLA8c1VIIGuhmo-EloJyMOQm4Q4vBjnu4J_ZxRspT1qVbVr3IYqzcB8RM5YdZeq4EELZEAWLGs7_1Jn_t9Mgc1uRN7cYyWB-TcFRcXUZbMMLsIRS6_mg-3MSJ7i-DWlxJGGuEHp6AdbwkxhBGUEPiPI_qilMiYpu9hbrg8v0gSRmYQmdomo-OQ_a8gkl-j_iWb9sllMkLYzS25i5IRz9oSjmY5r4u9crtm6jYP8oZYaDiDRGeAA' \
--header 'Content-Type: application/json' \
--data-raw '{
    "entity": "DIRECTOR",
    "director": {
        "name": "daniel",
        "lastName": "reynaga",
        "dateBirth": "15-02-1993"
    }
}'
~~~~~~~~~~~~~~~~~~~
JSON Request: Actor
~~~~~~~~~~~~~~~~~~~
{
    "entity": "ACTOR",
    "actor": {
        "name": "Nicolas!",
        "lastName": "Segura",
        "dateBirth": "11-02-1993"
    }
}

~~~~~~~~~~~~~~~~~~~
CURL:
~~~~~~~~~~~~~~~~~~~
curl --location --request POST 'http://localhost:8000/api/dataShow' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzI5NDE2NDAsImV4cCI6MTY3Mjk0NTI0MCwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6InRlc3RAZ21haWwuY29tIn0.GO_rj7vKFB7Rj-QQzH0A09oISUYa04GZ0tVgKjBiav1hbIx5Ggj406U09Gdv3GbMmWT49aDT7t32eJay8wgBMZw7bCYqwRWqMGFQnCQ4qO6qKTwbCw1CogE1DeInhDZ8vHl7ozyUeAGX3FphC3RaLl37XHLxQDcnbrMTetEgmcSgLGTdmLvhCZs6UXlRNQCe3dc6zI6BF1lKmchdB9olk7SdBTkCksDl3_FImhfU2cMp6atBpVNqY9Of_m1eNm0PTDZRT0-_K4QW34uZXysPMfE2h3VJ7OOvCO_4dTkf2qNwmVdGSToDTmUxmc8eceUw3afnoOqUfQVpdgK-_Us1ig' \
--header 'Content-Type: application/json' \
--data-raw '{
    "entity": "ACTOR",
    "actor": {
        "name": "Nicolas!",
        "lastName": "Segura",
        "dateBirth": "11-02-1993"
    }
}'
~~~~~~~~~~~~~~~~~~~
JSON Request: Temporada
~~~~~~~~~~~~~~~~~~~
{
    "entity": "SEASON",
    "season": {
        "numberSeason": 2,
        "releaseDate": "11-02-1993",
        "tvId": 2
    }
}
~~~~~~~~~~~~~~~~~~~
CURL:
~~~~~~~~~~~~~~~~~~~
curl --location --request POST 'http://localhost:8000/api/dataShow' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzI5MTExOTEsImV4cCI6MTY3MjkxNDc5MSwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6InRlc3RAZ21haWwuY29tIn0.bZ1NEn36bbI6cqCsgYZpglftyGfHAAXwuei6hiG_UWZewXs_d02qH0UJOA9ZmPLC4LeobILAXNrqnkU3pjij9_IRQtxiWH6t27qR3GgFjYIIbeyjF7-oMPSfCC11i_1ZdDHW1X-JRbkSgYanzAzco46xglGtz2O7OAoPXj0tsLbhcJJRcLgocQrsonyVeiJ57k0aTuhQp6x0PfrQbcYsm5uB1sEDHzBrPY2bpjeR17SIQqy5Sraflbd6Z4KNrsS5T-uylrQXCCvYfa2Ep9VYiopQ7L1RxSgtBuhPPKmQ7DndFyp4dRuPI9am7GMWgHP1vT_xQyth9FVd1iu5ZN5yAA' \
--header 'Content-Type: application/json' \
--data-raw '{
    "entity": "SEASON",
    "season": {
        "numberSeason": 2,
        "releaseDate": "11-02-1993",
        "tvId": 2
    }
}'
~~~~~~~~~~~~~~~~~~~
JSON Request: TV
~~~~~~~~~~~~~~~~~~~
{
    "entity": "TV",
    "tv": {
        "name": "test",
        "releaseDate": "11-02-1993",
        "directorId": 1
    }
}
~~~~~~~~~~~~~~~~~~~
CURL:
~~~~~~~~~~~~~~~~~~~
curl --location --request POST 'http://localhost:8000/api/dataShow' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzI5MTExOTEsImV4cCI6MTY3MjkxNDc5MSwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6InRlc3RAZ21haWwuY29tIn0.bZ1NEn36bbI6cqCsgYZpglftyGfHAAXwuei6hiG_UWZewXs_d02qH0UJOA9ZmPLC4LeobILAXNrqnkU3pjij9_IRQtxiWH6t27qR3GgFjYIIbeyjF7-oMPSfCC11i_1ZdDHW1X-JRbkSgYanzAzco46xglGtz2O7OAoPXj0tsLbhcJJRcLgocQrsonyVeiJ57k0aTuhQp6x0PfrQbcYsm5uB1sEDHzBrPY2bpjeR17SIQqy5Sraflbd6Z4KNrsS5T-uylrQXCCvYfa2Ep9VYiopQ7L1RxSgtBuhPPKmQ7DndFyp4dRuPI9am7GMWgHP1vT_xQyth9FVd1iu5ZN5yAA' \
--header 'Content-Type: application/json' \
--data-raw '{
    "entity": "TV",
    "tv": {
        "name": "test",
        "releaseDate": "11-02-1993",
        "directorId": 1
    }
}'
~~~~~~~~~~~~~~~~~~~
JSON Request: Episode
~~~~~~~~~~~~~~~~~~~
{
    "entity": "EPISODE",
    "episode": {
        "name":"N 1",
        "numberEpisode": 526,
        "releaseDate": "11-05-2005",
        "seasonId": 4
    }
}
~~~~~~~~~~~~~~~~~~~
CURL:
~~~~~~~~~~~~~~~~~~~
curl --location --request POST 'http://localhost:8000/api/dataShow' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzI5MjYxNTYsImV4cCI6MTY3MjkyOTc1Niwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6InRlc3RAZ21haWwuY29tIn0.OGeAHFpksnGIPf7RdhkScR2bEfME3zIDu2L46ElCT1EPiiipsxhAwd9t1yrrSHnTuVkmq8uE3CFSZT66CgdLGZKi9ixsTaZpO4aR8cDkSReQ2Rvshi7N5LSf-b7uB_-RDjUqWdTy4zEzBoEGYZkC4CM0YwUtxnYTd7YUET_hbKb3yYU1teMK_lrkFidhiiT8MZIAoUSQS23TUsK07wxx453ikUheZkRie6k2tR58sB8dpMBn390jmPRYS_EqG4tOnbtOdDuG06UEINK-RIl_GItRnLzXnA0rRSGcog3NBU59zxmcUcuVB8bWQLBr4R544KvwBAOv0Gh2ux4SJBLUVw' \
--header 'Content-Type: application/json' \
--data-raw '{
    "entity": "EPISODE",
    "episode": {
        "name":"N 1",
        "numberEpisode": 526,
        "releaseDate": "11-05-2005",
        "seasonId": 4
    }
}'
~~~~~~~~~~~~~~~~~~~
JSON Request: Peliculas
~~~~~~~~~~~~~~~~~~~
{
    "entity": "MOVIE",
    "movie": {
        "name": "Terminator",
        "releaseDate": "11-02-1993",
        "directorId": 1
    }
}
~~~~~~~~~~~~~~~~~~~
CURL:
~~~~~~~~~~~~~~~~~~~
curl --location --request POST 'http://localhost:8000/api/dataShow' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzI5MDY4NTAsImV4cCI6MTY3MjkxMDQ1MCwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6InRlc3RAZ21haWwuY29tIn0.ByLp5mxxaiFgcPH7zyEytv6lH4bfx8bLGaXgpTfazuxESt2GHtX3lK0Ypu8Gv75M4PVHfiOhAr9okPLf2X2HNZvwSfpS2MbhN4KbUXg6LN7FDWg-021qHP8zi8n1k0kDlevXCSPUej3QDMHWV3ZDqz25bspiY2JGlBm99K0XVT_w6XDvwpsGoezW7ua3nhuI_44H0xxCfZJ2rPRbxg3dXRGDdTn_mbX4F6EN5DptSK_K8rys6rZrwyjjXesnMdk7tYHwlzUvXX5BESN9Tmj2mMBcA0UZNbbIIZ9iDHcLew1JPH9Yqda6wW2D1mh3qYTVz6Z-RwvwPCVD7ty74tctKw' \
--header 'Content-Type: application/json' \
--data-raw '{
    "entity": "MOVIE",
    "movie": {
        "name": "Terminator",
        "releaseDate": "11-02-1993",
        "directorId": 1
    }
}'
~~~~~~~~~~~~~~~~~~~
Response:
~~~~~~~~~~~~~~~~~~~
{
    "result": "ok"
}
~~~~~~~~~~~~~~~~~~~

## Base de datos
- DER


<a href="https://ibb.co/pP2b7sH"><img src="https://i.ibb.co/j5hbNxC/Captura-de-pantalla-de-2023-01-05-15-13-09.png" alt="Captura-de-pantalla-de-2023-01-05-15-13-09" border="0"></a>

Es una base de datos MySQL y esta alojado en la nube de Amazon en el sistema de AWS RDS, si desea trabajar localmente puede ejecutar el siguiente comando para generar la base de datos

~~~~~~~~~~~~~~~~~~~
php bin/console --no-interaction doctrine:migration:migrate
~~~~~~~~~~~~~~~~~~~
