<?php

namespace App\Service;
use App\Entity\Genre;
use App\Model\Request\DataShowRequest;
use App\Service\DataShow\IDataShowInterface;
use Doctrine\ORM\EntityManagerInterface;



class GenreService implements IDataShowInterface{

    /**
     * @var EntityManagerInterface
    */
    private $em;
    function __construct(
        EntityManagerInterface $em,   
    )
    {
        $this->em = $em;     
    }
	public function addDataShow(DataShowRequest $dataShowRequest) {
        $genreEntity = $this->builDataShow($dataShowRequest);
        $this->em->persist($genreEntity);
        $this->em->flush();
	}

    public function builDataShow(DataShowRequest $dataShowRequest){
        $genreEntity = new Genre();
        $genreEntity->setName($dataShowRequest->getGenre()->getName()?$dataShowRequest->getGenre()->getName(): "");
        $genreEntity->setCreatedAt(date('d/m/y h:i:s'));
        return $genreEntity;
    }
}