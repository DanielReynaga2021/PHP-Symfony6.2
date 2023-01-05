<?php

namespace App\Service;
use App\Entity\Actor;
use App\Entity\Director;
use App\Model\Request\DataShowRequest;
use App\Service\DataShow\IDataShowInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;



class ActorService implements IDataShowInterface{

    /**
     * @var EntityManagerInterface
    */
    /**
     * @var DirectorService
    */
    private $em;
    private $directorService;
    function __construct(
        EntityManagerInterface $em,
        DirectorService $directorService,  
    )
    {
        $this->em = $em;
        $this->directorService = $directorService;
    }
	public function addDataShow(DataShowRequest $dataShowRequest) {
        
        $actorEntity = $this->builDataShow($dataShowRequest);
        $this->em->persist($actorEntity);
        $this->em->flush();
	}

    public function builDataShow(DataShowRequest $dataShowRequest){
        $actorEntity = new Actor();
        $actorEntity->setName($dataShowRequest->getActor()->getName()?$dataShowRequest->getActor()->getName(): "");
        $actorEntity->setLastName($dataShowRequest->getActor()->getLastName() ? $dataShowRequest->getActor()->getLastName() : "");
        $actorEntity->setDateBirth($dataShowRequest->getActor()->getDateBirth() ? $dataShowRequest->getActor()->getDateBirth() : "0000-00-00");
        $actorEntity->setCreatedAt(date('d/m/y h:i:s'));
        return $actorEntity;
    }
}