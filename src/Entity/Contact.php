<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Contact{

    /**
     *
     * @var string|null;
     * @Assert\NotBlank()
     * @Assert\Length(min =2, max=100)
     */
    private $firstname;

     /**
     *
     * @var string|null;
     * @Assert\NotBlank()
     * @Assert\Length(min =2, max=100)
     */
    private $lastname;

     /**
     *
     * @var string|null;
     * @Assert\NotBlank()
     * @Assert\Regex(
     * pattern="/[0-9]{10}/"
     * )
     */
    private $phone;

    /**
     *
     * @var string|null;
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     *
     * @var string|null;
     * @Assert\NotBlank()
     * @Assert\Length(min =10)
     */
    private $message;

    /**
     *
     * @var Property|null
     */
    private $property;

    /**
     *
     * @return  string|null;
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     *
     * @param  string|null;  $message  Undocumented variable
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string|null;
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set undocumented variable
     *
     * @param  string|null;  $email  Undocumented variable
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get pattern="/[0-9]{10}/"
     *
     * @return  string|null;
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set pattern="/[0-9]{10}/"
     *
     * @param  string|null;  $phone  pattern="/[0-9]{10}/"
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string|null;
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set undocumented variable
     *
     * @param  string|null;  $lastname  Undocumented variable
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string|null;
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set undocumented variable
     *
     * @param  string|null;  $firstname  Undocumented variable
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  Property|null
     */ 
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Set undocumented variable
     *
     * @param  Property|null  $property  Undocumented variable
     *
     * @return  self
     */ 
    public function setProperty($property)
    {
        $this->property = $property;

        return $this;
    }
}