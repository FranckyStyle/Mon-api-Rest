<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;
 

#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[ApiResource(
       normalizationContext: ['groups' => ["contact:read"]],
       denormalizationContext: ["groups"=>["contact:write"]]
)]



class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"AUTO")]
    #[ORM\Column(type: 'integer')]
    #[groups (["contact:read"])]
    private $id;


    #[ORM\Column(type: 'string', length: 100)]
    #[Groups(["contact:read", "contact:write"])]
    /**
     * @Assert\NotBlank()
     */    
    private $nom;


    #[ORM\Column(type: 'string', length: 100)]
    #[Groups(["contact:read", "contact:write"])]
    /**
     * @Assert\NotBlank()
     */
    private $prenom;


    #[ORM\Column(type: 'string', length: 180, nullable: true)]
    #[Groups(["contact:read", "contact:write"])]
    /**
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */ 
    private $email;


    #[ORM\Column(type: 'string',length:100 )]
    #[Groups(["contact:read", "contact:write"]),
              Length(10)]
    private $telephone;
     


    #[ORM\Column(type: "string", length:100)]
    #[Groups(["contact:read"])]
    private $slug;


    #[ORM\Column(type: 'integer')]
    #[Groups(["contact:read", "contact:write"])]
    /**
     * @Assert\NotBlank()
     *  
     * @Assert\GreaterThan(1)
     * @Assert\LessThanOrEqual(value = 100)
     *
     */
    private $age;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    
    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    } 

    

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
    
    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }
}
