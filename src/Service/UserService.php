<?php

namespace App\Service;

use App\Entity\User;
use App\Enum\ExceptionEnum;
use App\Model\Request\UserRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class UserService{

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
    public function createUser(UserRequest $requestBody){
        try{
            $userEntity = $this->buildUserEntity($requestBody);
            $this->em->persist($userEntity);
            $this->em->flush();
        }catch(\Exception $e){
            throw new NotFoundResourceException(ExceptionEnum::DUPLICATE_EMAIL);
        }
        
    }

    private function buildUserEntity(UserRequest $requestBody){
        $roles[] = 'ROLE_ADMIN';
        $userEntity = new User();
        $userEntity->setEmail($requestBody->getEmail());
        $userEntity->setPassword(password_hash($requestBody->getPassword(), PASSWORD_DEFAULT));
        $userEntity->setRoles($roles);
        return $userEntity;
    }
}