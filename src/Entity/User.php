<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $moneyTime;

    /**
     * @ORM\Column(type="text")
     */
    private $profilePic;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Services", mappedBy="user")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Services", mappedBy="solicitante")
     */
    private $servicesS;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="remitente")
     */
    private $messages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="users")
     */
    private $friendList;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="friendList")
     */
    private $users;

    public function __toString(){
        return (string) $this->id;
    }

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->servicesS = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->friendList = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        if($this->getEmail()=='admin@gmail.com'){
            $roles[] = 'ROLE_ADMIN';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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

    public function getMoneyTime(): ?int
    {
        return $this->moneyTime;
    }

    public function setMoneyTime(int $moneyTime): self
    {
        $this->moneyTime = $moneyTime;

        return $this;
    }

    public function getProfilePic(): ?string
    {
        return $this->profilePic;
    }

    public function setProfilePic(string $profilePic): self
    {
        $this->profilePic = $profilePic;

        return $this;
    }

    /**
     * @return Collection|Services[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Services $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->setUser($this);
        }

        return $this;
    }

    public function removeService(Services $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            // set the owning side to null (unless already changed)
            if ($service->getUser() === $this) {
                $service->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Services[]
     */
    public function getServicesS(): Collection
    {
        return $this->servicesS;
    }

    public function addServices(Services $services): self
    {
        if (!$this->servicesS->contains($services)) {
            $this->servicesS[] = $services;
            $services->setSolicitante($this);
        }

        return $this;
    }

    public function removeServices(Services $services): self
    {
        if ($this->servicesS->contains($services)) {
            $this->servicesS->removeElement($services);
            // set the owning side to null (unless already changed)
            if ($services->getSolicitante() === $this) {
                $services->setSolicitante(null);
            }
        }

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
            $message->setRemitente($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getRemitente() === $this) {
                $message->setRemitente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getFriendList(): Collection
    {
        return $this->friendList;
    }

    public function addFriendList(self $friendList): self
    {
        if (!$this->friendList->contains($friendList)) {
            $this->friendList[] = $friendList;
        }

        return $this;
    }

    public function removeFriendList(self $friendList): self
    {
        if ($this->friendList->contains($friendList)) {
            $this->friendList->removeElement($friendList);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(self $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addFriendList($this);
        }

        return $this;
    }

    public function removeUser(self $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeFriendList($this);
        }

        return $this;
    }
}
