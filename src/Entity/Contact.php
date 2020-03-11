<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Contact {

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email(message="Cet e-mail n'est pas valide.")
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $title;
    
    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $content;

    public function setFirstname(?string $firstname): Contact
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastname(?string $lastname): Contact
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function setEmail(?string $email): Contact
    {
        $this->email = $email;
        return $this;
    }

    public function setTitle(?string $title): Contact
    {
        $this->title = $title;
        return $this;
    }

    public function setContent(?string $content): Contact
    {
        $this->content = $content;
        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}