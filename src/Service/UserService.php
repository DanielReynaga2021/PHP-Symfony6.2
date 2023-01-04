<?php

namespace App\Service;

use App\Entity\User;
use App\Model\Request\UserRequest;
use Doctrine\ORM\EntityManagerInterface;

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
        $userEntity = $this->buildUserEntity($requestBody);
        $this->em->persist($userEntity);
        $this->em->flush();
    }

    public function buildUserEntity(UserRequest $requestBody){
        $roles[] = 'ROLE_ADMIN';
        $userEntity = new User();
        $userEntity->setEmail($requestBody->getEmail());
        $userEntity->setPassword(password_hash($requestBody->getPassword(), PASSWORD_DEFAULT));
        $userEntity->setRoles($roles);
        return $userEntity;
    }
}