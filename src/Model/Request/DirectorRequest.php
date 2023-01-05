<?php

namespace App\Model\Request;

use DateTime;

class DirectorRequest{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $lastName;

    /**
     * @var DateTime|null
     */
    private $dateBirth;


    /**
     * Get the value of name
     *
     * @return  string|null
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string|null  $name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of lastName
     *
     * @return  string|null
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @param  string|null  $lastName
     *
     * @return  self
     */ 
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of dateBirth
     *
     * @return  DateTime|null
     */ 
    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    /**
     * Set the value of dateBirth
     *
     * @param  DateTime|null  $dateBirth
     *
     * @return  self
     */ 
    public function setDateBirth($dateBirth)
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }
}