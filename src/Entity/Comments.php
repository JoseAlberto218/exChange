<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 */
class Comments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $emisor;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $mensaje;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $receptor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $respondido;

    public function __toString(){
        return (string) $this->id;
    }

    public function __construct($emisor, $mensaje, $receptor, $respondido){
        $this->emisor=$emisor;
        $this->mensaje=$mensaje;
        $this->receptor=$receptor;
        $this->respondido=$respondido;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmisor(): ?string
    {
        return $this->emisor;
    }

    public function setEmisor(string $emisor): self
    {
        $this->emisor = $emisor;

        return $this;
    }

    public function getMensaje(): ?string
    {
        return $this->mensaje;
    }

    public function setMensaje(string $mensaje): self
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    public function getReceptor(): ?string
    {
        return $this->receptor;
    }

    public function setReceptor(string $receptor): self
    {
        $this->receptor = $receptor;

        return $this;
    }

    public function getRespondido(): ?bool
    {
        return $this->respondido;
    }

    public function setRespondido(bool $respondido): self
    {
        $this->respondido = $respondido;

        return $this;
    }
}
