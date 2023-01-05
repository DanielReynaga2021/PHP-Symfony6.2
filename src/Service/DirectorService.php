<?php

namespace App\Service;
use App\Entity\Director;
use App\Model\Request\DataShowRequest;
use App\Service\DataShow\IDataShowInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Translation\Exception\NotFoundResourceException;



class DirectorService implements IDataShowInterface{

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
        $userEntity = $this->builDataShow($dataShowRequest);
        $this->em->persist($userEntity);
        $this->em->flush();
	}

    private function builDataShow(DataShowRequest $dataShowRequest){
        $directorEntity = new Director();
        $directorEntity->setName($dataShowRequest->getDirector()->getName()?$dataShowRequest->getDirector()->getName(): "");
        $directorEntity->setLastName($dataShowRequest->getDirector()->getLastName() ? $dataShowRequest->getDirector()->getLastName() : "");
        $directorEntity->setDateBirth($dataShowRequest->getDirector()->getDateBirth() ? $dataShowRequest->getDirector()->getDateBirth() : "");
        $directorEntity->setCreatedAt(date('d/m/y h:i:s'));
        return $directorEntity;
    }

    public function getDirector(int $id){
        $director = $this->em->getRepository(Director::class)->find($id);
        if(!$director){
            throw new NotFoundResourceException("Not found in the database");
        }
        return $director;
    }
}