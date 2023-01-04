<?php

namespace App\Model\Request;

use Symfony\Component\Validator\Constraints as Assert;

class UserRequest
{

    /**
     * @Assert\Email(message = "The email {{ value }} is not a valid email.")
     * @Assert\NotBlank(message="field is required")
     * @Assert\NotNull(message="field is required")
     * @Assert\Length(max=255, maxMessage="The field must be lower than {{ limit }}")
     * @Assert\Type("string", message="field must be {{ type }}")
     */
    private $email;

    /**
     * @Assert\NotBlank(message="field is required")
     * @Assert\NotNull(message="field is required")
     * @Assert\Length(max=255, maxMessage="The field must be lower than {{ limit }}")
     * @Assert\Type("string", message="field must be {{ type }}")
     */
    private $password;

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}