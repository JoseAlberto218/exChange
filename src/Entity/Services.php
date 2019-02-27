<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServicesRepository")
 */
class Services
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $cost;

    /**
     * @ORM\Column(type="boolean")
     */
    private $availability;

    /**
     * @ORM\Column(type="boolean")
     */
    private $completed;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="services")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="services")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="servicesS")
     */
    private $solicitante;

    /**
     * @ORM\Column(type="integer")
     */
    private $numSolicit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="destinatario")
     */
    private $messages;

    public function __toString(){
        return (string) $this->id;
    }

    public function __construct($title, $description, $image, $cost, $availability, $completed, $user, $city, $category, $numSolicit, $solicitante){
        $this->title=$title;
        $this->description=$description;
        $this->image=$image;
        $this->cost=$cost;
        $this->availability=$availability;
        $this->completed=$completed;
        $this->user=$user;
        $this->city=$city;
        $this->category=$category;
        $this->solicitante=$solicitante;
        $this->numSolicit=$numSolicit;
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getCompleted(): ?bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): self
    {
        $this->completed = $completed;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getSolicitante(): ?User
    {
        return $this->solicitante;
    }

    public function setSolicitante(?User $solicitante): self
    {
        $this->solicitante = $solicitante;

        return $this;
    }

    public function getNumSolicit(): ?int
    {
        return $this->numSolicit;
    }

    public function setNumSolicit(int $numSolicit): self
    {
        $this->numSolicit = $numSolicit;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setDestinatario($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getDestinatario() === $this) {
                $message->setDestinatario(null);
            }
        }

        return $this;
    }
}
